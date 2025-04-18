<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$appTitle}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="container">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">{{$appTitle}} Detail</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">View {{$appTitle}} information with related
                            people and department</p>
                    </div>


                    <div class="space-x-2">
                        <x-tc-button label="⬅ Back" :link="route('departments.index', [
        'page' => request('page'),
        'search' => request('search'),
    ])" white />
                        <x-tc-button label="✏️ Edit {{$appTitle}}" :link="route('departments.edit', [
        'department' => $department,
        'page' => request('page'),
        'search' => request('search'),
    ])" />

                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 space-y-6">
                    <!-- Department Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department
                            Name</label>
                        <div class="mt-1 p-3 bg-gray-100 dark:bg-gray-700 rounded-md text-gray-800 dark:text-white">
                            {{ $department->name }}
                        </div>
                    </div>

                    <!-- Department Detail -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <div
                            class="mt-1 p-3 bg-gray-100 dark:bg-gray-700 rounded-md text-gray-800 dark:text-white whitespace-pre-line">
                            {{ $department->detail ?? '—' }}
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Department People</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">List of people in this department</p>
                </div>


                <!-- People in Department Card -->
                <div class="p-6 mt-6 bg-white dark:bg-gray-800 shadow rounded-xl">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">People in this Department</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">List of assigned people</p>
                    </div>

                    @if ($department->people->count())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($department->people as $index => $person)
                                <li class="py-3 flex items-center justify-between">
                                    <div>
                                        <div class="font-medium text-gray-800 dark:text-white">
                                            {{ $index + 1 }}. {{ $person->name }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            Role: {{ $person->role }}<br>
                                            Missions: {{ $person->missions->count() }}
                                        </div>
                                    </div>

                                    <div class="flex gap-2">
                                        <a href="{{ route('people.show', $person->id) }}"
                                            class="text-blue-600 hover:underline text-sm">View</a>
                                        <a href="{{ route('people.edit', $person->id) }}"
                                            class="text-yellow-500 hover:underline text-sm">Edit</a>
                                        <form method="POST" action="{{ route('people.destroy', $person->id) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this person?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline text-sm">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-4">
                            {{ $people->links() }}
                        </div>
                    @else
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            No people assigned to this department.
                        </div>
                    @endif


                </div>

                <!-- div container -->
            </div>

        </div>
    </div>
</x-app-layout>