<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $appTitle }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="max-w mx-auto">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit {{$appTitle}}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Edit information about this {{$appTitle}}</p>
                </div>

                <div class="bg-white rounded-2xl shadow dark:bg-gray-800  p-6">
                    <form action="{{ route('people.update', $person) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <x-tc-input type="text" name="name" label="Name" value="{{ old('name', $person->name) }}"
                            required />
                        <x-tc-input type="text" name="role" label="Role" value="{{ old('role', $person->role) }}"
                            required />
                        <x-tc-select name="department_id" label="Department" :options="collect()" required>
                            @foreach ($departments as $id => $name)
                                <option value="{{ $id }}" {{ $person->department_id == $id ? 'selected' : '' }}> {{ $name }}
                                </option>
                            @endforeach
                        </x-tc-select>

                        <x-tc-textarea name="notes" label="Notes" rows="4" value="{{ old('notes', $person->notes) }}"
                            auto-resize />

                        <div class="flex justify-end space-x-4">
                            <x-tc-button label="Cancel" :link="route('people.index')" white />
                            <x-tc-button type="submit" label="update {{ $appTitle }}" />
                        </div>

                    </form>
                </div>

            </div>




        </div>
    </div>
    </div>
</x-app-layout>