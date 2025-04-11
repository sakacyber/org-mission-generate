<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Departments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="container">
                <form method="GET" class="mb-3">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by Department Name" class="form-control mb-2">
                    <button class="btn btn-secondary">Search</button>
                </form>

                <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Add New Department</a>
                <a href="{{ route('departments.export', ['format' => 'csv']) }}"
                    class="btn btn-outline-secondary mb-3">Export
                    CSV</a>
                <a href="{{ route('departments.export', ['format' => 'xlsx']) }}"
                    class="btn btn-outline-secondary mb-3">Export
                    Excel</a>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>{{ $department->name }}</td>
                                <td>
                                    <a href="{{ route('departments.show', $department) }}"
                                        class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('departments.edit', $department) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('departments.destroy', $department) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>