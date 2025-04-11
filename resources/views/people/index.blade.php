<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


        <div class="container">
            <h2>People</h2>
            <form method="GET" class="mb-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search"
                    class="form-control mb-2">
                <select name="sort" class="form-control mb-2">
                    <option value="">Sort By</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="role" {{ request('sort') == 'role' ? 'selected' : '' }}>Role</option>
                </select>
                <button class="btn btn-secondary">Filter</button>
            </form>
            <a href="{{ route('people.create') }}" class="btn btn-primary mb-3">Add New Person</a>
            @foreach($people as $person)
                <div class="card mb-2">
                    <div class="card-body">
                        <h5>{{ $person->name }} - {{ $person->role }}</h5>
                        <p>Department: {{ $person->department->name }}</p>
                        <a href="{{ route('people.show', $person) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('people.edit', $person) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('people.destroy', $person) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <script>
        function searchPersons() {
            let searchTerm = document.getElementById('search').value.toLowerCase();
            let rows = document.querySelectorAll('#personTable tr');

            rows.forEach(row => {
                let name = row.cells[0].textContent.toLowerCase();
                if (name.indexOf(searchTerm) === -1) {
                    row.style.display = 'none';
                } else {
                    row.style.display = '';
                }
            });
        }
    </script>
    </div>
    </div>
 </x-app-layout>