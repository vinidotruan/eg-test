<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Health Stats') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto sm:px-6 lg:px-8">
            <x-anomaly-panel :anomalies="$anomalies" />
        </div>
    </div>

    <div class="py-4">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <x-weight-height-chart
                    :labels="$weightHeightLabels"
                    :weights="$weights"
                    :heights="$heights" />
                <x-steps-chart
                    :labels="$stepsLabels"
                    :data="$stepsData" />
            </div>

            <div class="grid grid-cols-2 gap-4">
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

