<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Health Stats') }}
        </h2>
    </x-slot>

<div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8">

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="bg-white shadow-sm rounded p-4">
                <h3 class="text-lg font-bold mb-2">Weight & Height</h3>
                <div class="relative h-64">
                    <canvas id="weightHeightChart" class="w-full h-full"></canvas>
                </div>
            </div>
            <div class="bg-white shadow-sm rounded p-4">
                <h3 class="text-lg font-bold mb-2">Steps</h3>
                <div class="relative h-64">
                    <canvas id="stepsChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="bg-white shadow-sm rounded p-4">
                <h3 class="text-lg font-bold mb-2">Heart Rate</h3>
                <div class="relative h-64">
                    <canvas id="heartRateChart" class="w-full h-full"></canvas>
                </div>
            </div>
            <div class="bg-white shadow-sm rounded p-4">
                <h3 class="text-lg font-bold mb-2">Blood Pressure</h3>
                <div class="relative h-64">
                    <canvas id="bloodPressureChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const weightHeightLabels=@json($weightHeightLabels);
        const weights=@json($weights);
        const heights=@json($heights);
        const ctxWeightHeight=document.getElementById('weightHeightChart').getContext('2d');
        new Chart(ctxWeightHeight,{
            type:'line',
            data:{
                labels:weightHeightLabels,
                datasets:[
                    {
                        label:'Weight (kg)',
                        data:weights,
                        borderColor:'rgba(75,192,192,1)',
                        backgroundColor:'rgba(75,192,192,0.2)',
                        fill:false,
                        tension:0.1
                    },
                    {
                        label:'Height (cm)',
                        data:heights,
                        borderColor:'rgba(153,102,255,1)',
                        backgroundColor:'rgba(153,102,255,0.2)',
                        fill:false,
                        tension:0.1
                    }
                ]
            },
            options:{
                scales:{
                    y:{
                        beginAtZero:false
                    }
                }
            }
        });

        const stepsLabels=@json($stepsLabels);
        const stepsData=@json($stepsData);
        const ctxSteps=document.getElementById('stepsChart').getContext('2d');
        new Chart(ctxSteps,{
            type:'bar',
            data:{
                labels:stepsLabels,
                datasets:[
                    {
                        label:'Steps',
                        data:stepsData,
                        backgroundColor:'rgba(255,99,132,0.2)',
                        borderColor:'rgba(255,99,132,1)',
                        borderWidth:1
                    }
                ]
            },
            options:{
                scales:{
                    y:{
                        beginAtZero:true
                    }
                }
            }
        });

        const heartRateLabels=@json($heartRateLabels);
        const heartRateData=@json($heartRateData);
        const ctxHeartRate=document.getElementById('heartRateChart').getContext('2d');
        new Chart(ctxHeartRate,{
            type:'line',
            data:{
                labels:heartRateLabels,
                datasets:[
                    {
                        label:'BPM',
                        data:heartRateData,
                        borderColor:'rgba(255,206,86,1)',
                        backgroundColor:'rgba(255,206,86,0.2)',
                        fill:false,
                        tension:0.1
                    }
                ]
            },
            options:{
                scales:{
                    y:{
                        beginAtZero:false
                    }
                }
            }
        });

        const bpLabels=@json($bpLabels);
        const systolicData=@json($systolicData);
        const diastolicData=@json($diastolicData);
        const ctxBloodPressure=document.getElementById('bloodPressureChart').getContext('2d');
        new Chart(ctxBloodPressure,{
            type:'line',
            data:{
                labels:bpLabels,
                datasets:[
                    {
                        label:'Systolic',
                        data:systolicData,
                        borderColor:'rgba(54,162,235,1)',
                        backgroundColor:'rgba(54,162,235,0.2)',
                        fill:false,
                        tension:0.1
                    },
                    {
                        label:'Diastolic',
                        data:diastolicData,
                        borderColor:'rgba(255,159,64,1)',
                        backgroundColor:'rgba(255,159,64,0.2)',
                        fill:false,
                        tension:0.1
                    }
                ]
            },
            options:{
                scales:{
                    y:{
                        beginAtZero:false
                    }
                }
            }
        });
    </script></x-app-layout>
