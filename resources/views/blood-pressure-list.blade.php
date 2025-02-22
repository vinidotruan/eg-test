<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Blood Pressure List
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Systolic</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diastolic</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($records as $record)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->systolic }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->diastolic }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $record->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-6 py-4">
                    {{ $records->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
