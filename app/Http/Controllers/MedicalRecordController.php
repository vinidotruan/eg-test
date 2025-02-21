<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\MedicalRecord\StoreRequest;

class MedicalRecordController extends Controller
{
    public function store(int $id, StoreRequest $request): JsonResponse
    {
        $data = [...$request->all(), 'user_id' => $id];
        $mr = MedicalRecord::create($data);
        return response()->json(['data' => $mr]);
    }
}
