<?php

namespace App\Http\Controllers;

use App\Http\Requests\BloodPressure\StoreRequest;
use App\Models\BloodPressure;
use Illuminate\Http\JsonResponse;

class BloodPressureController extends Controller
{
    public function store(int $id, StoreRequest $request): JsonResponse
    {
        $data = [...$request->all(), 'user_id' => $id];
        $bp = BloodPressure::create($data);
        return response()->json(['data' => $bp]);
    }
}
