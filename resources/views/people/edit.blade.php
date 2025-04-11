<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        
        <div class="container">
            <h2>Edit Person</h2>
            <form action="{{ route('people.update', $person) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $person->name }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Role</label>
                    <input type="text" name="role" value="{{ $person->role }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Department</label>
                    <select name="department_id" class="form-control">
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ $person->department_id == $dept->id ? 'selected' : '' }}>
                                {{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
        
    </div>
</div>
</div>
</x-app-layout>