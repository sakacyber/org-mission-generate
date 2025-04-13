<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Missions') }}
            <x-breadcrumb>
                <x-breadcrumb-item label="Home" :href="route('dashboard')" icon-none />
                <x-breadcrumb-item label="Missions" :href="route('missions.index')" />
                <x-breadcrumb-item label="Edit" />
            </x-breadcrumb>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            <div class="containter max-w">
                <h2 class="text-2xl font-bold mb-6">✏️ Edit Mission</h2>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-800 p-4 rounded">
                        <strong>Whoops!</strong> Please fix the errors below.
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('missions.update', $mission->id) }}" method="POST"
                    class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded shadow">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium mb-1">Mission Id</label>
                            <input type="text" value="{{ $mission->id }}"
                                class="form-input w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                                readonly>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Signature Date</label>
                            <input type="date" name="signature_date"
                                value="{{ old('signature_date', $mission->signature_date) }}"
                                class="form-input w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                                readonly>
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Mission Goal</label>
                        <input type="text" name="goal" value="{{ old('goal', $mission->goal) }}"
                            class="form-input w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                            required>
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Mission Location</label>
                        <input type="text" name="place" value="{{ old('place', $mission->place) }}"
                            class="form-input w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                            required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium mb-1">Start Date</label>
                            <input type="date" name="start_date" value="{{ old('start_date', $mission->start_date) }}"
                                class="form-input w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                                required>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">End Date</label>
                            <input type="date" name="end_date" value="{{ old('end_date', $mission->end_date) }}"
                                class="form-input w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Assign People</label>
                        <select name="people_id[]" multiple required
                            class="form-multiselect w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            @foreach($people as $person)
                                <option value="{{ $person->id }}" {{ in_array($person->id, $mission->people->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $person->name }} ({{ $person->department->name ?? 'No Dept' }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-gray-500 dark:text-gray-400">Hold Ctrl/Cmd to select multiple</small>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('missions.index') }}"
                            class="px-4 py-2 rounded bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600">←
                            Cancel</a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">💾
                            Update Mission</button>
                    </div>
                </form>
            </div>




        </div>
    </div>
</x-app-layout>