<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Mission Details</h2>
                    <a href="{{ route(name: 'missions.export.docx', $mission->id) }}" class="btn btn-outline-primary">Download DOCX</a>
                    <a href="{{ route('missions.index') }}" class="btn btn-secondary">Back to List</a>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">{{ $mission->goal }}</h4>
                        <p><strong>Location:</strong> {{ $mission->place }}</p>
                        <p><strong>Mission Date:</strong> {{ $mission->mission_date }}</p>
                        <p><strong>CEO Signature Date:</strong> {{ $mission->ceo_signature_date }}</p>
                    </div>
                </div>

                <div class="mb-3">
                    <h5>Assigned People</h5>
                    @if($mission->people->count())
                        <ul class="list-group">
                            @foreach($mission->people as $person)
                                <li class="list-group-item">
                                    {{ $person->name }} — <em>{{ $person->department->name }}</em>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No people assigned.</p>
                    @endif
                </div>

                <div class="mt-4 d-flex gap-2">
                    <a href="{{ route('missions.edit', $mission) }}" class="btn btn-warning">Edit Mission</a>

                    <form action="{{ route('missions.destroy', $mission) }}" method="POST"
                        onsubmit="return confirm('Are you sure?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger">Delete Mission</button>
                    </form>

                    <a href="{{ route('missions.export.docx', $mission->id) }}" class="btn btn-outline-primary">Download
                        DOCX</a>

                    <a href="{{ route('missions.print', $mission->id) }}" target="_blank"
                        class="btn btn-outline-secondary">Print
                        View</a>
                </div>
            </div>


            

        </div>
    </div>
</x-app-layout>