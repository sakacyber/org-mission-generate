<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="max-w mx-auto p-6 bg-white rounded-2xl shadow dark:bg-gray-800">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Create New {{$appTitle}}</h2>

                <form action="{{ route('people.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <x-tc-input type="text" name="name" label="Name" value="{{ old('name') }}" required />
                    <x-tc-input type="text" name="role" label="Role" value="{{ old('role') }}" required />
                    <x-tc-select name="department_id" label="Department" :options="$departments" required />
                    <x-tc-textarea name="notes" label="Notes" rows="4" value="{{ old('notes') }}" auto-resize/>

                    <div class="flex justify-end space-x-4">
                        <x-tc-button label="Cancel" :link="route('people.index')" white />
                        <x-tc-button type="submit" label="Create People" />
                    </div>
                </form>
            </div>


        </div>
    </div>
</x-app-layout>