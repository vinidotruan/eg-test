<div class="bg-white shadow-sm rounded p-4">
    <h3 class="text-lg font-bold mb-2">Steps</h3>
    <div class="relative h-64">
        <canvas id="stepsChart" class="w-full h-full"></canvas>
    </div>
</div>

@push('scripts')
<script>
    const stepsLabels = @json($labels);
    const stepsData = @json($data);
    const ctxSteps = document.getElementById('stepsChart').getContext('2d');

    new Chart(ctxSteps, {
        type: 'bar',
        data: {
            labels: stepsLabels,
            datasets: [
                {
                    label: 'Steps',
                    data: stepsData,
                    backgroundColor: 'rgba(255,99,132,0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endpush
