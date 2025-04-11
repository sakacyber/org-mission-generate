<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Missions') }}
        </h2>

    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 px-4 py-2 rounded bg-green-100 text-green-800 dark:bg-green-800 dark:text-white">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 px-4 py-2 rounded bg-red-100 text-red-800 dark:bg-red-800 dark:text-white">
                    {{ session('error') }}
                </div>
            @endif

            <div class="p-4 align-right">
                <x-tc-button><a href="{{ route('missions.create')}}">Add New Mission</a></x-bladewind::button>
                <!-- <x-bladewind::button>Export CSV</x-bladewind::button> -->
                <!-- <x-bladewind::button>Export Excel</x-bladewind::button> -->
                <!-- <a href="{{ route('missions.export', ['format' => 'csv']) }}" class="btn btn-outline-secondary mb-3">Export
                CSV</a>
            <a href="{{ route('missions.export', ['format' => 'xlsx']) }}" class="btn btn-outline-secondary mb-3">Export
                Excel</a> -->
            </div>

            <x-tc-card class="max-w">
                <x-tc-table :paginate="$missions" searchable hoverable>
                    <x-slot:heading>
                        <x-tc-th label="#" />
                        <x-tc-th label="Goal" />
                        <x-tc-th label="Place" />
                        <x-tc-th label="Date" />
                        <x-tc-th label="People" />
                        <x-tc-th label="Action" />
                    </x-slot:heading>

                    @forelse ($missions as $mission)
                        <x-tc-tr>
                            <x-tc-td :label="$mission->id" />
                            <x-tc-td :label="$mission->goal" />
                            <x-tc-td :label="$mission->place" />
                            <x-tc-td class="text-center">{{ $mission->start_date }}
                                <p>{{ $mission->end_date }}</p>
                            </x-tc-td>
                            <x-tc-td>
                                @foreach($mission->people as $person)
                                    {{ $person->name }} ({{ $person->department->name }})<br>
                                @endforeach
                            </x-tc-td>

                            <x-tc-td class="space-x-2">
                                <x-tc-dropdown>
                                    <x-slot:trigger>
                                        <x-tc-button icon="ellipsis-vertical" flat gray circle />
                                    </x-slot:trigger>

                                    <x-tc-dropdown-item label="View" icon="eye"
                                        link="{{ route('missions.show', $mission->id) }}" />
                                    <x-tc-dropdown-item label="Edit" icon="pencil-square"
                                        link="{{ route('missions.edit', $mission->id) }}" />
                                    <x-tc-dropdown-item label="Delete" icon="trash"
                                        link="{{ route('missions.destroy', $mission) }}" />
                                </x-tc-dropdown>
                            </x-tc-td>

                        </x-tc-tr>
                    @empty
                        <x-tc-not-found />
                    @endforelse
                </x-tc-table>
            </x-tc-card>



        </div>

    </div>
    </div>
</x-app-layout>