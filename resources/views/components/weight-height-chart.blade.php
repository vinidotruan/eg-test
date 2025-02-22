<div class="bg-white shadow-sm rounded p-4">
    <h3 class="text-lg font-bold mb-2">Weight & Height</h3>
    <div class="relative h-64">
        <canvas id="weightHeightChart" class="w-full h-full"></canvas>
    </div>
</div>

@push('scripts')
    <script>
        const weightHeightLabels = @json($labels);
        const weights = @json($weights);
        const heights = @json($heights);
        const ctxWeightHeight = document.getElementById('weightHeightChart').getContext('2d');

        new Chart(ctxWeightHeight, {
            type: 'line',
            data: {
                labels: weightHeightLabels,
                datasets: [
                    {
                        label: 'Weight (kg)',
                        data: weights,
                        borderColor: 'rgba(75,192,192,1)',
                        backgroundColor: 'rgba(75,192,192,0.2)',
                        fill: false,
                        tension: 0.1
                    },
                    {
                        label: 'Height (cm)',
                        data: heights,
                        borderColor: 'rgba(153,102,255,1)',
                        backgroundColor: 'rgba(153,102,255,0.2)',
                        fill: false,
                        tension: 0.1
                    }
                ]
            },
            options: {
                scales: {
                    y: { beginAtZero: false }
                }
            }
        });
    </script>
@endpush
