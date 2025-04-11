<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create People') }}
            </h2>

            <form method="POST" action="{{ route('people.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" name="role" required>
                </div>

                <div class="mb-3">
                    <label for="department_id" class="form-label">Department</label>
                    <select multiple class="form-control" id="department_id" name="department_id" required>
                        @foreach ($departments as $dep)
                            <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label0">Notes</label>
                    <input type="text" class="form-control" id="notes" name="notes">
                </div>

                <button type="submit" class="btn btn-success">Create</button>
            </form>

        </div>
    </div>
</x-app-layout>