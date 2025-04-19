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

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="container">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Mission Detail</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">View mission information with related people
                            and department</p>
                    </div>


                    <div class="space-x-2">
                         <button class="btn btn-neutral">Neutral</button>
                        <button class="btn btn-primary">Primary</button>
                        <button class="btn btn-secondary">Secondary</button>
                        <button class="btn btn-accent">Accent</button>
                        <button class="btn btn-info">Info</button>
                        <button class="btn btn-success">Success</button>
                        <button class="btn btn-warning">Warning</button>
                        <button class="btn btn-error">Error</button>
                        <button class="btn btn-ghost">Ghost</button>
                        <button class="btn btn-link">Link</button>
                        <button class="btn btn-link btn-disabled">Link Disabled</button>
                    
                        <x-tc-button label="⬅️ Back" :link="route('missions.index', [
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
                <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 mt-6">
                    <h3 class="text-lg font-bold mb-4">Mission Overview</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-md ">
                        <div>
                            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-200">🎯 Goal</h3>
                            <p class=" text-gray-600 dark:text-gray-300">{{ $mission->goal }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-200">📍 Location</h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ $mission->place }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-200">📅 Mission Date</h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ formatKhmerDate($mission->start_date) }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-200">📅 Signature Date</h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ formatKhmerDate($mission->signature_date) }}
                            </p>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-200">📅 End Date</h3>
                            <p class=" text-gray-600 dark:text-gray-300">{{ formatKhmerDate($mission->end_date) }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-200">📅 Create Date</h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ formatKhmerDate($mission->created_at) }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-200">🚌 Travel</h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ $mission->travel ?? '-'}}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-200">💰 Sponsore:</h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ $mission->sponsore ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Department People</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">List of people in this mission</p>
                </div>

                <!-- People Involved Card -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 mt-6">
                    <h2 class="text-gray-600 dark:text-gray-300 font-bold">👥 People Assigned</h2>
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th class="py-2">#</th>
                                <th class="py-2">Name</th>
                                <th class="py-2">Gender</th>
                                <th class="py-2">Role</th>
                                <th class="py-2">Department</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mission->people as $index => $person)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="py-2">{{ $index + 1 }}</td>
                                    <td class="py-2">{{ $person->name }}</td>
                                    <td class="py-2">{{ $person->notes }}</td>
                                    <td class="py-2">{{ $person->role }}</td>
                                    <td class="py-2">{{ $person->department->name ?? '-' }}</td>
                                </tr>
                            @empty
                                <x-tc-not-found />
                            @endforelse
                        </tbody>
                    </table>
                </div>


                <!-- Open the modal using ID.showModal() method -->
                <button class="btn" onclick="my_modal_1.showModal()">open modal</button>
                <dialog id="my_modal_1" class="modal">
                    <div class="modal-box">
                        <h3 class="text-lg font-bold">Hello!</h3>
                        <p class="py-4">Press ESC key or click the button below to close</p>
                        <div class="modal-action">
                            <form method="dialog">
                                <!-- if there is a button in form, it will close the modal -->
                                <button class="btn">Close</button>
                            </form>
                        </div>
                    </div>
                </dialog>

                

                <!-- div container -->
            </div>



        </div>
    </div>
</x-app-layout>