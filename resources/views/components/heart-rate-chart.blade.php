<div class="bg-white shadow-sm rounded p-4">
    <h3 class="text-lg font-bold mb-2">Heart Rate</h3>
    <div class="relative h-64">
        <canvas id="heartRateChart" class="w-full h-full"></canvas>
    </div>
</div>

@push('scripts')
<script>
    const heartRateLabels = @json($labels);
    const heartRateData = @json($data);
    const ctxHeartRate = document.getElementById('heartRateChart').getContext('2d');

    new Chart(ctxHeartRate, {
        type: 'line',
        data: {
            labels: heartRateLabels,
            datasets: [
                {
                    label: 'BPM',
                    data: heartRateData,
                    borderColor: 'rgba(255,206,86,1)',
                    backgroundColor: 'rgba(255,206,86,0.2)',
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
