
@props(['anomalies'])

@php
    $latestAnomaly = $anomalies->sortByDesc('created_at')->first();
@endphp

<div x-data="{ showHistory: false }" class="bg-white border border-gray-200 rounded p-4 w-full max-w-xl">
    <h2 class="text-xl font-bold mb-3">Anomaly Panel</h2>

    @if($latestAnomaly)
        <div class="mb-4 text-sm text-gray-800">
            <span class="font-semibold">Most Recent Anomaly:</span>
            <div class="mt-1 p-2 bg-red-50 rounded">
                <p class="mb-1">
                    <span class="font-semibold">Date:</span>
                    {{ $latestAnomaly->created_at->format('m/d/Y H:i') }}
                </p>
                <p>
                    <span class="font-semibold">Data:</span>
                    {{ $latestAnomaly->data }}
                </p>
            </div>
        </div>
    @else
        <div class="mb-4 text-gray-600">
            No anomalies found.
        </div>
    @endif

    <div class="flex space-x-2">
        <form method="POST" action="{{ url('/check') }}">
            @csrf
            <button
                type="submit"
                class="px-4 py-2 bg-[#A27B55] text-white rounded hover:bg-[#8c6a45] focus:outline-none">
                Consult anomalies
            </button>
        </form>

        <button
            type="button"
            class="flex items-center px-4 py-2 bg-[#A27B55] text-white rounded hover:bg-[#c0a28f] focus:outline-none"
            @click="showHistory = true">
            View History
        </button>
    </div>

    <div
        x-show="showHistory"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center"
        style="background-color: rgba(0,0,0,0.5); display: none;"
        @click.away="showHistory = false"
    >
        <div class="bg-white w-3/5 p-6 mx-auto rounded shadow">
            <h3 class="text-lg font-bold mb-3">Anomaly History</h3>
            <ul class="space-y-2 mb-4 max-h-64 overflow-y-auto">
                @foreach($anomalies->sortByDesc('created_at') as $anomaly)
                    <li class="border-b pb-1">
                        <span class="block text-sm font-semibold">
                            {{ $anomaly->created_at->format('m/d/Y H:i') }}
                        </span>
                        <span class="block text-sm text-gray-700">
                            {{ $anomaly->data }}
                        </span>
                    </li>
                @endforeach
            </ul>
            <button
                type="button"
                class="px-4 py-2 bg-[#E8E1D8] text-[#A27B55] rounded hover:bg-[#d5cbbd] focus:outline-none"
                @click="showHistory = false">
                Close
            </button>
        </div>
    </div>
</div>

