<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="container">
                <h2>Edit Department</h2>
                <form action="{{ route('departments.update', $department) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Department Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $department->name) }}"
                            required>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Update Department</button>
                    <a href="{{ route('departments.index') }}" class="btn btn-secondary mt-3">Back to Departments</a>
                </form>
            </div>

        </div>
    </div>
    </div>
</x-app-layout>
