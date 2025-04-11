<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="container">


                <div class="p-4 align-right">
                    <x-tc-button link="{{ route('people.create')}}">Add New People</x-tc-button>
                </div>

                <x-tc-card class="max-w">
                    <x-tc-table :paginate="$people" searchable hoverable>
                        <x-slot:heading>
                            <x-tc-th label="#" />
                            <x-tc-th label="Name" />
                            <x-tc-th label="Role" />
                            <x-tc-th label="Department" />
                            <x-tc-th label="Notes" />
                            <x-tc-th label="Action" />
                        </x-slot:heading>

                        @forelse ($people as $person)
                            <x-tc-tr>
                                <x-tc-td :label="$person->id" />
                                <x-tc-td :label="$person->name" />
                                <x-tc-td :label="$person->role" />
                                <x-tc-td :label="$person->department->name" />
                                <x-tc-td :label="$person->notes" />

                                <x-tc-td class="space-x-2">
                                    <x-tc-dropdown>
                                        <x-slot:trigger>
                                            <x-tc-button icon="ellipsis-vertical" flat gray circle />
                                        </x-slot:trigger>

                                        <x-tc-dropdown-item label="View" icon="eye"
                                            link="{{ route('people.show', $person) }}" />
                                        <x-tc-dropdown-item label="Edit" icon="pencil-square"
                                            link="{{ route('people.edit', $person) }}" />
                                        <x-tc-dropdown-item label="Delete" icon="trash"
                                            link="{{ route('people.destroy', $person) }}" />
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
    </div>
</x-app-layout>