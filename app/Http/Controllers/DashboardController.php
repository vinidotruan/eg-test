<?php

namespace App\Http\Controllers;

use App\Models\BloodPressure;
use App\Models\HeartBeat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $medicalRecords = $user->medicalRecords()->latest()->take(100)->get();
        $steps = $user->steps()->latest()->take(100)->get();
        $heartRates = $user->heartBeats()->latest()->take(100)->get();
        $bloodPressures = $user->bloodPressures()->latest()->take(100)->get();

        return view('dashboard',[
            ...$this->getMedicalChartData($medicalRecords),
            ...$this->getStepsChartData($steps),
            ...$this->getHeartRatesChartData($heartRates),
            ...$this->getBloodPressureChartdata($bloodPressures),
            'anomalies' => $user->anomalies,
        ]);
    }

    public function bloodPressureList(): View
    {
        return view('blood-pressure-list', ['records' => BloodPressure::latest()->paginate(15)]);
    }

    public function heartBeatsList(): View
    {
        return view('heart-beats-list', ['records' => HeartBeat::latest()->paginate(15)]);
    }

    private function getBloodPressureChartdata($bloodPressures): array
    {
        $bloodPressureLabels = $bloodPressures
            ->pluck('created_at')
            ->map(fn ($date) => $this->parseDate($date))
            ->toArray();

        $systolicData = $bloodPressures->pluck('systolic')->toArray();
        $diastolicData = $bloodPressures->pluck('diastolic')->toArray();

        return [ 'bloodPressureLabels' => $bloodPressureLabels, 'systolicData' => $systolicData, 'diastolicData' => $diastolicData ];
    }

    private function getHeartRatesChartData($heartRates): array
    {
        $heartRateLabels = $heartRates
            ->pluck('created_at')
            ->map(fn ($date) => $this->parseDate($date))
            ->toArray();
        $heartRateData = $heartRates->pluck('data')->toArray();

        return [ 'heartRateLabels' => $heartRateLabels, 'heartRateData' => $heartRateData ];
    }

    private function getMedicalChartData($medicalRecords): array
    {
        $weightHeightLabels = $medicalRecords
            ->pluck('created_at')
            ->map(fn ($date) => $this->parseDate($date))
            ->toArray();
        $weights = $medicalRecords->pluck('weight')->toArray();
        $heights = $medicalRecords->pluck('height')->toArray();

        return ['weightHeightLabels' => $weightHeightLabels, 'weights' => $weights, 'heights' => $heights ];
    }

    private function getStepsChartData($steps): array
    {
         $stepsLabels = $steps
           ->pluck('created_at')
           ->map(fn ($date) => $this->parseDate($date))
           ->toArray();
        $stepsData = $steps->pluck('data')->toArray();

        return [ 'stepsLabels' => $stepsLabels, 'stepsData' => $stepsData ];
    }

    private function parseDate($date): string
    {
        return Carbon::parse($date)->format('m/d/Y H:i');
    }
}
