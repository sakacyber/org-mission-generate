<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="container">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">{{$appTitle}} Detail</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">View {{$appTitle}} information with related
                            missions</p>
                    </div>


                    <div class="space-x-2">
                        <x-tc-button label="⬅ Back" :link="route('people.index', [
        'page' => request('page'),
        'search' => request('search'),
    ])" white />
                        <x-tc-button label="✏️ Edit {{$appTitle}}" :link="route('people.edit', [
        'person' => $person->id,
        'page' => request('page'),
        'search' => request('search'),
    ])" />

                    </div>
                </div>

                <div class="space-y-6">

                    {{-- Person Detail Card --}}
                    <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{$appTitle}} Overview</h2>
                            <a href="{{ route('people.edit', $person) }}"
                                class="text-sm text-blue-500 hover:underline">Edit</a>
                        </div>

                        <div class="text-gray-600 dark:text-gray-300 space-y-2">
                            <p><strong>Name:</strong> {{ $person->name }}</p>
                            <p><strong>Role:</strong> {{ $person->role }}</p>
                            <p><strong>Department:</strong> {{ $person->department?->name ?? '-' }}</p>
                            <p><strong>Notes:</strong> {{ $person->notes ?? 'N/A' }}</p>
                        </div>
                    </div>

                    {{-- Missions Card Below --}}
                    <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Missions</h3>

                        @if($person->missions->count())
                            <ul class="space-y-4">
                                @foreach($person->missions as $mission)
                                    <li class="border rounded-lg p-4 dark:border-gray-700">
                                        <h4 class="text-md font-semibold text-gray-800 dark:text-white">{{ $mission->goal }}
                                        </h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">Date:
                                            {{ $mission->start_date }}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">Location:
                                            {{ $mission->place }}
                                        </p>
                                        <a href="{{ route('missions.show', $mission) }}"
                                            class="text-blue-500 text-sm hover:underline">View
                                            Details</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">This person has no missions assigned.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- div container -->
        </div>

    </div>
    </div>
</x-app-layout>