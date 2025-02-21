<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load(['medicalRecords','steps','heartBeats','bloodPressures']);

        $weightHeightLabels = $user->medicalRecords()->pluck('created_at')->map(function($date){
            return Carbon::parse($date)->format('m/d/Y H:i');
        })->toArray();
        $weights = $user->medicalRecords()->pluck('weight')->toArray();
        $heights = $user->medicalRecords()->pluck('height')->toArray();

        $stepsLabels = $user->steps()->pluck('created_at')->map(function($date){
            return Carbon::parse($date)->format('m/d/Y H:i');
        })->toArray();
        $stepsData = $user->steps()->pluck('data')->toArray();

        $heartRateLabels = $user->heartBeats()->pluck('created_at')->map(function($date){
            return Carbon::parse($date)->format('m/d/Y H:i');
        })->toArray();
        $heartRateData = $user->heartBeats()->pluck('bpm')->toArray();

        $bpLabels = $user->bloodPressures()->pluck('created_at')->map(function($date){
            return Carbon::parse($date)->format('m/d/Y H:i');
        })->toArray();

        $systolicData = $user->bloodPressures()->pluck('systolic')->toArray();
        $diastolicData = $user->bloodPressures()->pluck('diastolic')->toArray();

        return view('dashboard',[
            'weightHeightLabels'=>$weightHeightLabels,
            'weights'=>$weights,
            'heights'=>$heights,
            'stepsLabels'=>$stepsLabels,
            'stepsData'=>$stepsData,
            'heartRateLabels'=>$heartRateLabels,
            'heartRateData'=>$heartRateData,
            'bpLabels'=>$bpLabels,
            'systolicData'=>$systolicData,
            'diastolicData'=>$diastolicData
        ]);
    }
}
