<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$appTitle}}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="max-w mx-auto mt-4">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit {{$appTitle}}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Edit information about this {{$appTitle}}</p>
                </div>

                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl">
                    <form action="{{ route('departments.update', $department) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <x-tc-input type="text" name="name" label="Department Name"
                            value="{{ old('name', $department->name) }}" required />
                        <x-tc-textarea name="notes" label="Notes" rows="4" value="{{ old('notes', $department->notes) }}"
                            auto-resize />

                        <div class="flex justify-end space-x-4">
                            <x-tc-button label="Cancel" :link="route('departments.index')" white />
                            <x-tc-button type="submit" label="Update {{$appTitle}}" />
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
    </div>
</x-app-layout>