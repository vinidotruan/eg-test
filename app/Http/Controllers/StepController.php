<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Step\StoreRequest;

class StepController extends Controller
{
    public function store(int $id, StoreRequest $request): JsonResponse
    {
        $data = [...$request->all(), 'user_id' => $id];
        $step = Step::create($data);
        return response()->json(['data' => $step]);
    }
}
