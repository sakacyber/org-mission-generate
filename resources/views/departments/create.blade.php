<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Departments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create Department') }}
            </h2>

            <div class="container">
                <h2>Create Department</h2>
                <form action="{{ route('departments.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Department Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Create Department</button>
                    <a href="{{ route('departments.index') }}" class="btn btn-secondary mt-3">Back to Departments</a>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>