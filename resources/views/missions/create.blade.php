<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ $appTitle }}
            <x-tc-breadcrumb>
                <x-tc-breadcrumb-item label="Home" :href="route('dashboard')" icon-none />
                <x-tc-breadcrumb-item label="{{ $appTitle }}" :href="route('missions.index')" />
                <x-tc-breadcrumb-item label="Create" />
            </x-tc-breadcrumb>
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="max-w mx-auto mt-4 mb-4">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Create New {{ $appTitle }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Create a new {{ $appTitle }} and add it to the system.</p>  
            </div>

            <div class="max-w mx-auto p-6 bg-white rounded-2xl shadow dark:bg-gray-800">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                    {{ __('New Mission') }}
                </h2>

                <form method="POST" action="{{ route('missions.store') }}" class="space-y-6">
                    @csrf
                    <x-tc-input name="uid" label="Id" suffix="/2025 លបប.កសមឡ" required />
                    <x-tc-input name="goal" label="Goal" required />
                    <x-tc-input name="place" label="Place" required />
                    <x-tc-input name="start_date" label="Start Date" type="date" required />
                    <x-tc-input name="end_date" label="End Date" type="date" required />
                    <x-tc-input name="signature_date" label="Signature Date" type="date" required />
                    <x-tc-select name="people_id" label="Assign People" :options="$people"
                        hint="Multi people can select" multiple required />
                    <x-tc-textarea name="notes" label="Notes" rows="4" auto-resize />

                    <div class="flex justify-end space-x-4">
                        <x-tc-button label="Cancel" :link="route('missions.index')" white />
                        <x-tc-button type="submit" label="Create {{ $appTitle }}" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>