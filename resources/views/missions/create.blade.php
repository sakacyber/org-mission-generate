<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Missions') }}
            <x-tc-breadcrumb>
                <x-tc-breadcrumb-item label="Home" :href="route('dashboard')" icon-none />
                <x-tc-breadcrumb-item label="Missions" :href="route('missions.index')" />
                <x-tc-breadcrumb-item label="Create" />
            </x-tc-breadcrumb>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="max-w mx-auto p-6 bg-white rounded-2xl shadow dark:bg-gray-800">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                    {{ __('Create Mission') }}
                </h2>

                <form method="POST" action="{{ route('missions.store') }}" class="space-y-6">
                    @csrf
                    <x-tc-input name="goal" label="Goal" required />
                    <x-tc-input name="place" label="Place" required />
                    <x-tc-input name="start_date" label="Start Date" type="date" required />
                    <x-tc-input name="end_date" label="End Date" type="date" required />
                    <x-tc-input name="signature_date" label="Signature Date" type="date" required />
                    <x-tc-select name="people_id" label="Assign People" :options="$people"
                        hint="Multi people can select" multiple required />
                    <x-tc-textarea name="notes" label="Notes" row="4" auto-resize />

                    <div class="flex justify-end space-x-4">
                        <x-tc-button label="Cancel" :link="route('missions.index')" white />
                        <x-tc-button type="submit" label="Create Mission" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>