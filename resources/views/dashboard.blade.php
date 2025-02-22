<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Health Stats') }}
        </h2>
    </x-slot>

    @if(session('alert'))
        <div x-data="{ show: true }" x-show="show" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded shadow-lg flex items-center space-x-4 z-50" role="alert">
            <span>{{ session('alert') }}</span>
            <button @click="show = false" class="text-blue-700 focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif


    <div class="py-4">
        <div class="mx-auto sm:px-6 lg:px-8">
            <x-anomaly-panel :anomalies="$anomalies" />
        </div>
    </div>

    <div class="py-4">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <x-weight-height-chart
                    :labels="$weightHeightLabels"
                    :weights="$weights"
                    :heights="$heights" />
                <x-steps-chart
                    :labels="$stepsLabels"
                    :data="$stepsData" />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <x-heart-rate-chart
                    :labels="$heartRateLabels"
                    :data="$heartRateData" />
                <x-blood-pressure-chart
                    :labels="$bloodPressureLabels"
                    :systolic="$systolicData"
                    :diastolic="$diastolicData" />
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</x-app-layout>

