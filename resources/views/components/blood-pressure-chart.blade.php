<div class="bg-white shadow-sm rounded p-4">
    <h3 class="text-lg font-bold mb-2">Blood Pressure</h3>
    <div class="relative h-64">
        <canvas id="bloodPressureChart" class="w-full h-full"></canvas>
    </div>
</div>

@push('scripts')
<script>
    const bpLabels = @json($labels);
    const systolicData = @json($systolic);
    const diastolicData = @json($diastolic);
    const ctxBloodPressure = document.getElementById('bloodPressureChart').getContext('2d');

    new Chart(ctxBloodPressure, {
        type: 'line',
        data: {
            labels: bpLabels,
            datasets: [
                {
                    label: 'Systolic',
                    data: systolicData,
                    borderColor: 'rgba(54,162,235,1)',
                    backgroundColor: 'rgba(54,162,235,0.2)',
                    fill: false,
                    tension: 0.1
                },
                {
                    label: 'Diastolic',
                    data: diastolicData,
                    borderColor: 'rgba(255,159,64,1)',
                    backgroundColor: 'rgba(255,159,64,0.2)',
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
