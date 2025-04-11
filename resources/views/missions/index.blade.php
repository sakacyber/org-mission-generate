<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <form method="GET" class="mb-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search"
                        class="form-control mb-2">
                    <select name="sort" class="form-control mb-2">
                        <option value="">Sort By</option>
                        <option value="start_date" {{ request('sort') == 'start_date' ? 'selected' : '' }}>Mission
                            Date</option>
                    </select>
                    <button class="btn btn-secondary">Filter</button>
                </form>

                <a href="{{ route('missions.create') }}" class="btn btn-primary mb-3">Add New Mission</a>
                <a href="{{ route('missions.export', ['format' => 'csv']) }}"
                    class="btn btn-outline-secondary mb-3">Export CSV</a>
                <a href="{{ route('missions.export', ['format' => 'xlsx']) }}"
                    class="btn btn-outline-secondary mb-3">Export Excel</a>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Goal</th>
                            <th>Place</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>People</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($missions as $mission)
                            <tr>
                                <td>{{ $mission->goal }}</td>
                                <td>{{ $mission->place }}</td>
                                <td>{{ $mission->start_date }}</td>
                                <td>{{ $mission->end_date }}</td>
                                <td>
                                    @foreach($mission->people as $person)
                                        {{ $person->name }} ({{ $person->department->name }})<br>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('missions.generate-docx', $mission->id) }}" target="_blank">DOCX</a> |
                                    <a href="{{ route('missions.generate-pdf', $mission->id) }}" target="_blank">PDF</a> |
                                    <a href="{{ route('missions.edit', $mission->id) }}">Edit</a> |
                                    <form action="{{ route('missions.destroy', $mission->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
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