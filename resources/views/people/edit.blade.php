<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">




            <div class="max-w mx-auto p-6 bg-white rounded-2xl shadow dark:bg-gray-800">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Edit Person</h2>

                <form action="{{ route('people.update', $person) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name"
                            class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $person->name) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="role"
                            class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                        <input type="text" id="role" name="role" value="{{ old('role', $person->role) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="department_id"
                            class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Department</label>
                        <select id="department_id" name="department_id"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">-- Select Department --</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id', $person->department_id) == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="notes"
                            class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                        <textarea id="notes" name="notes" rows="4"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('notes', $person->notes) }}</textarea>
                        @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('people.index') }}"
                            class="inline-block px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-300 dark:hover:bg-gray-600">Cancel</a>
                        <x-tc-button type="submit">Update</x-tc-button>
                    </div>
                </form>
            </div>




        </div>
    </div>
    </div>
</x-app-layout>