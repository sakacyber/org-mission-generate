<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="container">
        <h1>Edit Mission: {{ $mission->goal }}</h1>

        <form method="POST" action="{{ route('missions.update', $mission->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="goal" class="form-label">Goal</label>
                <input type="text" class="form-control" id="goal" name="goal" value="{{ $mission->goal }}" required>
            </div>

            <div class="mb-3">
                <label for="mission_date" class="form-label">Mission Date</label>
                <input type="date" class="form-control" id="mission_date" name="mission_date"
                    value="{{ $mission->mission_date }}" required>
            </div>

            <div class="mb-3">
                <label for="ceo_signature_date" class="form-label">CEO Signature Date</label>
                <input type="date" class="form-control" id="ceo_signature_date" name="ceo_signature_date"
                    value="{{ $mission->ceo_signature_date }}" required>
            </div>

            <div class="mb-3">
                <label for="person_ids" class="form-label">Assign People</label>
                <select multiple class="form-control" id="person_ids" name="person_ids[]" required>
                    @foreach ($people as $person)
                        <option value="{{ $person->id }}" {{ in_array($person->id, $mission->people->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $person->name }} ({{ $person->department->name }})
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
    </div>
    </div>
    </x-app-layout>