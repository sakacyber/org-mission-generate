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
                        <x-tc-input type="text" label="Mission Id" value="{{ $mission->id }}" readonly />

                        <x-tc-input type="text" label="📅 Create Date"
                            value="{{ $mission->created_at->format('d-M-Y') }}" readonly />

                        <x-tc-input type="text" name="goal" label="🎯 Goal" 
                            value="{{ old('goal', $mission->goal) }}" required />

                        <x-tc-input type="text" name="place" label="📍 Location"
                            value="{{ old('place', $mission->place) }}" required />

                        <x-tc-input type="date" name="start_date" label="📅 Start Date"
                            value="{{ old('start_date', $mission->start_date) }}" required />

                        <x-tc-input type="date" name="end_date" label="📅 End Date"
                            value="{{ old('end_date', $mission->end_date) }}" required />

                        <x-tc-input type="text" label="👥 Assing People" value="{{ $mission->people->count() }} People"
                            readonly />

                        <x-tc-input type="text" name="signature_date" label="📅 Signature Date"
                            value="{{ $mission->signature_date }}" readonly />
                    </div>

                    <x-tc-select name="people_id[]" label="Assign People" :options="$people->pluck('name', 'id')"
                        hint="Multi people can select" multiple required>
                        @foreach($people as $id => $name)
                            <option value="{{ $id }}" {{ in_array($id, $mission->people->pluck('id')->toArray()) ? 'selected' : '' }} label="{{ $name }}">
                                {{ $name }}
                            </option>
                        @endforeach
                    </x-tc-select>


                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('missions.index', [
    'page' => request('page'),
    'search' => request('search'),
]) }}" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600">←
                            Cancel</a>
                        <x-tc-button type="submit" label="Update Mission" />
                    </div>
                </form>
            </div>




        </div>
    </div>
</x-app-layout>