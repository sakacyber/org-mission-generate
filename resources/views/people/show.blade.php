<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
        
        <div class="container">
            <h2>Person Details</h2>
            <p><strong>Name:</strong> {{ $person->name }}</p>
            <p><strong>Role:</strong> {{ $person->role }}</p>
            <p><strong>Department:</strong> {{ $person->department->name }}</p>
            <a href="{{ route('people.edit', $person) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('people.index') }}" class="btn btn-secondary">Back</a>
        </div>
        
        </div>
    </div>
</x-app-layout>