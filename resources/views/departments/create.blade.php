<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$appTitle}}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            <div class="max-w mx-auto mt-4">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Create New {{$appTitle}}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Create a new {{$appTitle}} and add it to the system.</p>

                <div class="bg-white rounded-xl dark:bg-gray-800 p-6 mt-4">

                    <form action="{{ route('departments.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <x-tc-input type="text" name="name" label="Department Name" value="{{ old('name') }}" required />
                        <x-tc-textarea name="notes" label="Notes" rows="4" auto-resize />

                        <div class="flex justify-end space-x-4">
                            <x-tc-button label="Cancel" :link="route('departments.index')" white />
                            <x-tc-button type="submit" label="Create {{$appTitle}}" />
                        </div>
                    </form>
                </div>
            </div>





        </div>
    </div>
</x-app-layout>