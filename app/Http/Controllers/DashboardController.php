<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $weightHeightLabels = $user->medicalRecords()
            ->pluck('created_at')
            ->map(fn ($date) => $this->parseDate($date))
            ->toArray();
        $weights = $user->medicalRecords()->pluck('weight')->toArray();
        $heights = $user->medicalRecords()->pluck('height')->toArray();

        $stepsLabels = $user->steps()
           ->pluck('created_at')
           ->map(fn ($date) => $this->parseDate($date))
           ->toArray();
        $stepsData = $user->steps()->pluck('data')->toArray();

        $heartRateLabels = $user->heartBeats()
            ->pluck('created_at')
            ->map(fn ($date) => $this->parseDate($date))
            ->toArray();
        $heartRateData = $user->heartBeats()->pluck('data')->toArray();

        $bloodPressureLabels = $user->bloodPressures()
            ->pluck('created_at')
            ->map(fn ($date) => $this->parseDate($date))
            ->toArray();

        $systolicData = $user->bloodPressures()->pluck('systolic')->toArray();
        $diastolicData = $user->bloodPressures()->pluck('diastolic')->toArray();

        return view('dashboard',[
            'weightHeightLabels' => $weightHeightLabels,
            'weights' => $weights,
            'heights' => $heights,
            'stepsLabels' => $stepsLabels,
            'stepsData' => $stepsData,
            'heartRateLabels' => $heartRateLabels,
            'heartRateData' => $heartRateData,
            'bloodPressureLabels' => $bloodPressureLabels,
            'systolicData' => $systolicData,
            'diastolicData' => $diastolicData,
            'anomalies' => $user->anomalies,
        ]);
    }

    private function parseDate($date): string
    {
        return Carbon::parse($date)->format('m/d/Y H:i');
    }
}
