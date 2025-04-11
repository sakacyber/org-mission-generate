<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="container">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Create Mission') }}
                </h2>

                <form method="POST" action="{{ route('missions.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="goal" class="form-label">Goal</label>
                        <input type="text" class="form-control" id="goal" name="goal" required>
                    </div>

                    <div class="mb-3">
                        <label for="place" class="form-label">Place</label>
                        <input type="text" class="form-control" id="place" name="place" required>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="signature_date" class="form-label">Signature Date</label>
                        <input type="date" class="form-control" id="signature_date" name="signature_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="people_id" class="form-label">Assign People</label>
                        <select  class="form-select" id="people_id" name="people_id[]" multiple required>
                            @foreach ($people as $person)
                                <option value="{{ $person->id }}">{{ $person->name }} ({{ $person->department->name }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    
                    <button type="submit" class="btn btn-primary">Create Mission</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>