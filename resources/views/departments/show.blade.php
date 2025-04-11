<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Departments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="container">
                <h2>Department Details</h2>
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $department->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Department Name:</strong> {{ $department->name }}</p>
                        <a href="{{ route('departments.edit', $department) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('departments.index') }}" class="btn btn-secondary mt-3">Back to
                            Departments</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>