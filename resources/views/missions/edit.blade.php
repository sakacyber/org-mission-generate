<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Missions') }}
            <x-tc-breadcrumb>
                <x-tc-breadcrumb-item label="Home" :href="route('dashboard')" icon-none />
                <x-tc-breadcrumb-item label="Missions" :href="route('missions.index')" />
                <x-tc-breadcrumb-item label="Edit" />
            </x-tc-breadcrumb>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            <div class="containter max-w">
                <h2 class="text-2xl font-bold mb-4">✏️ Edit Mission</h2>

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

                <form action="{{ route('missions.update', [
    'mission' => $mission->id,
    'page' => request('page'),
    'search' => request('search'),
]) }}" method="POST" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-medium mb-1">Mission Id</label>
                            <input type="text" value="{{ $mission->id }}"
                                class="form-input w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                                readonly>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">📅 Create Date</label>
                            <input type="datetime" 
                                value="{{ old('created_at', $mission->created_at) }}"
                                class="form-input w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                                readonly>
                        </div>

                        <div>
                            <label class="block font-medium mb-1">🎯 Goal</label>
                            <input type="text" name="goal" value="{{ old('goal', $mission->goal) }}"
                                class="form-input w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                                required>
                        </div>

                        <div>
                            <label class="block font-medium mb-1">📍 Location</label>
                            <input type="text" name="place" value="{{ old('place', $mission->place) }}"
                                class="form-input w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                                required>
                        </div>

                        <div>
                            <label class="block font-medium mb-1">📅 Start Date</label>
                            <input type="date" name="start_date" value="{{ old('start_date', $mission->start_date) }}"
                                class="form-input w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                                required>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">📅 End Date</label>
                            <input type="date" name="end_date" value="{{ old('end_date', $mission->end_date) }}"
                                class="form-input w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                                required>
                        </div>

                        <div>
                            <label class="block font-medium mb-1">👥 Assing People</label>
                            <input type="text" value="{{ $mission->people->count() }} People"
                                class="form-input w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                                readonly>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">📅 Signature Date</label>
                            <input type="date" name="signature_date" value="{{ old('signature_date', $mission->signature_date) }}"
                                class="form-input w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                                readonly>
                        </div>
                    </div>

                    


                    <div class="mb-3">
                        <x-select name="people_id[]" label="Assign People" :options="$people->pluck('name', 'id')" wire:model="people_id" 
                            hint="Multi people can select" multiple required>
                            @foreach($people as $id => $name)
                                <option value="{{ $id }}" {{ in_array($id, $mission->people->pluck('id')->toArray()) ? 'selected' : '' }} label="{{ $name }}">
                                    {{ $name }} 
                                </option>
                            @endforeach
                        </x-select>
                    </div>



                    <div class="flex justify-between">
                        <a href="{{ route('missions.index', [
    'page' => request('page'),
    'search' => request('search'),
]) }}" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600">←
                            Cancel</a>
                        <x-tc-button type="submit" class="px-6 py-2 text-white hover:bg-blue-700">💾
                            Update Mission</x-tc-button>
                    </div>
                </form>
            </div>




        </div>
    </div>
</x-app-layout>