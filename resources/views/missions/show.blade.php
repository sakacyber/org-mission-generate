<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Missions') }}
            <x-breadcrumb>
                <x-breadcrumb-item label="Home" :href="route('dashboard')" icon-none />
                <x-breadcrumb-item label="Missions" :href="route('missions.index')" />
                <x-breadcrumb-item label="Show" />
            </x-breadcrumb>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



        <div class="container">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Mission Details</h2>
                <div class="space-x-2">
                    <a href="{{ route('missions.index') }}"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-sm rounded hover:bg-gray-300">
                        ← Back to Missions
                    </a>
                    
                </div>
            </div>
        
            <!-- Mission Info Card -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 mb-6">
                <h3 class="text-lg font-bold mb-4">Mission Overview</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="font-medium">Goal:</span> {{ $mission->goal }}
                    </div>
                    <div>
                        <span class="font-medium">Location:</span> {{ $mission->place }}
                    </div>
                    <div>
                        <span class="font-medium">Mission Date:</span> {{ $mission->start_date }}
                    </div>
                    <div>
                        <span class="font-medium">End Date:</span> {{ $mission->end_date }}
                    </div>
                    <div>
                        <span class="font-medium">Signature Date:</span> {{ $mission->signature_date }} <x-badge label="#{{ $mission->id }}" outline />
                    </div>
                    <div>
                        <span class="font-medium">People Assigned:</span> {{ $mission->people->count() }}
                    </div>
                </div>
            </div>
        
            <!-- People Involved Card -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h3 class="text-lg font-bold mb-4">People Assigned</h3>
                <table class="min-w-full text-sm table-auto">
                    <thead>
                        <tr class="text-left bg-gray-100 dark:bg-gray-700">
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Gender</th>
                            <th class="px-4 py-2">Role</th>
                            <th class="px-4 py-2">Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mission->people as $index => $person)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                <td class="px-4 py-2">{{ $person->name }}</td>
                                <td class="px-4 py-2">{{ $person->notes }}</td>
                                <td class="px-4 py-2">{{ $person->role }}</td>
                                <td class="px-4 py-2">{{ $person->department->name ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


            

        </div>
    </div>
</x-app-layout>