<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Missions') }}
            <x-tc-breadcrumb>
                <x-tc-breadcrumb-item label="Home" :href="route('dashboard')" icon-none />
                <x-tc-breadcrumb-item label="Missions" :href="route('missions.index')" />
                <x-tc-breadcrumb-item label="Show" />
            </x-tc-breadcrumb>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="container">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Mission Detail</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">View mission information with related people
                            and department</p>
                    </div>


                    <div class="space-x-2">
                        <x-tc-button label="⬅ Back" :link="route('missions.index', [
        'page' => request('page'),
        'search' => request('search'),
    ])" white />
                        <x-tc-button label="✏️ Edit Mission" :link="route('missions.edit', [
        'mission' => $mission->id,
        'page' => request('page'),
        'search' => request('search'),
    ])" />

                    </div>
                </div>

                <!-- Mission Info Card -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 mb-6">
                    <h3 class="text-lg font-bold mb-4">Mission Overview</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-md">
                        <div>
                            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200">🎯 Goal:</h2>
                            <p class=" text-gray-600 dark:text-gray-300">{{ $mission->goal }}</p>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200">📍 Location:</h2>
                            <p class="text-gray-600 dark:text-gray-300">{{ $mission->place }}</p>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200">📅 Mission Date:</h2>
                            <p class="text-gray-600 dark:text-gray-300">{{ formatKhmerDate($mission->start_date) }}</p>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200">📅 Signature Date:</h2>
                            <p class="text-gray-600 dark:text-gray-300">{{ formatKhmerDate($mission->signature_date) }}
                            </p>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200">📅 End Date:</h2>
                            <p class=" text-gray-600 dark:text-gray-300">{{ formatKhmerDate($mission->end_date) }}</p>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200">📅 Create Date:</h2>
                            <p class="text-gray-600 dark:text-gray-300">{{ formatKhmerDate($mission->created_at) }}</p>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200">👥 People Assign:</h2>
                            <p class="text-gray-600 dark:text-gray-300">{{ $mission->people->count() }} People</p>
                        </div>
                    </div>
                </div>

                <!-- People Involved Card -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                    <h3 class="text-lg font-bold mb-4">👥 People Assigned</h3>
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
                            @forelse($mission->people as $index => $person)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $person->name }}</td>
                                    <td class="px-4 py-2">{{ $person->notes }}</td>
                                    <td class="px-4 py-2">{{ $person->role }}</td>
                                    <td class="px-4 py-2">{{ $person->department->name ?? '-' }}</td>
                                </tr>
                            @empty
                                <x-tc-not-found />
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>



        </div>
    </div>
</x-app-layout>