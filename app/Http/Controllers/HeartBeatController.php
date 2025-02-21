<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeartBeat\StoreRequest;
use App\Models\HeartBeat;
use Illuminate\Http\JsonResponse;

class HeartBeatController extends Controller
{
    public function store(int $id, StoreRequest $request): JsonResponse
    {
        $data = [...$request->all(), 'user_id' => $id];
        $heartBeat = HeartBeat::create($data);
        return response()->json(['data' => $heartBeat]);
    }
}
