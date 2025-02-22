<?php

namespace App\Services;

use App\Models\Anomaly;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class AnomalyDetectionService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
        ]);
    }

    public function detectAnomaly(array $dataPoints): array
    {
        $serializedData = json_encode($dataPoints);
        $prompt = "You are a medical anomaly detection system. "
                . "Below is a JSON with health readings. Decide if the data is anomalous or normal. "
                . "Return a JSON, no backticks or formatting with 'anomaly': true/false and a short reason.\n\n"
                . $serializedData;

        try {
            $response = $this->client->post('chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'temperature' => 0.0,
                    'max_tokens' => 100,
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            $assistantMessage = $body['choices'][0]['message']['content'] ?? null;
            if ($assistantMessage) {
                $result = json_decode($assistantMessage, true);
                if (is_array($result) && isset($result['anomaly'])) {

                    Anomaly::create(['data' => $result['reason'], 'user_id' => $dataPoints['id']]);
                    return $result;
                }
            }
        } catch (\Exception $e) {
            Log::info("error calling openAI", [$e->getMessage()]);
            return ['anomaly' => false, 'reason' => 'Error calling OpenAI: ' . $e->getMessage()];
        }

        return ['anomaly' => false, 'reason' => 'Could not parse response'];
    }
}
