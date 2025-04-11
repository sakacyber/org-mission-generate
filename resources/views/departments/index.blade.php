<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Departments') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="container">
        

                <div class="p-4 align-right">
                    <x-tc-button link="{{ route('departments.create')}}">Add New Department</x-tc-button>
                </div>
                
                <x-tc-card class="max-w">
                    <x-tc-table :paginate="$departments" searchable hoverable>
                        <x-slot:heading>
                            <x-tc-th label="#" />
                            <x-tc-th label="Name" />
                            <x-tc-th label="Created" />
                            <x-tc-th label="People" />
                            <x-tc-th label="Notes" />
                            <x-tc-th label="Action" />
                        </x-slot:heading>
                
                        @forelse ($departments as $department)
                            <x-tc-tr>
                                <x-tc-td :label="$department->id" />
                                <x-tc-td :label="$department->name" />
                                <x-tc-td :label="$department->created_at" />
                                <x-tc-td :label="$department->people->count()" />
                                <x-tc-td :label="$department->notes" />

                                <x-tc-td class="space-x-2">
                                    <x-tc-dropdown>
                                        <x-slot:trigger>
                                            <x-tc-button icon="ellipsis-vertical" flat gray circle />
                                        </x-slot:trigger>
                                        <x-tc-dropdown-item label="View" icon="eye" link="{{ route('departments.show', $department) }}" />
                                        <x-tc-dropdown-item label="Edit" icon="pencil" link="{{ route('departments.edit', $department) }}" />
                                        <x-tc-dropdown-item label="Delete" icon="trash" link="{{ route('departments.destroy', $department) }}" />
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