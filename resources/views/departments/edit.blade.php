<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$appTitle}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="max-w mx-auto mt-5 p-6 bg-white dark:bg-gray-800 shadow-lg rounded-2xl">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit {{$appTitle}}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Edit information about this {{$appTitle}}</p>
                </div>

                <form action="{{ route('departments.update', $department) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Department
                            Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $department->name) }}"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="notes"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Notes</label>
                        <textarea name="notes" id="notes" rows="4"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">{{ old('detail', $department->detail) }}</textarea>
                        @error('notes')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                        <x-tc-button label="Cancel" :link="route('departments.index')" white />
                        <x-tc-button type="submit" label="Update {{$appTitle}}" />
                    </div>
                </form>
            </div>



        </div>
    </div>
    </div>
</x-app-layout>