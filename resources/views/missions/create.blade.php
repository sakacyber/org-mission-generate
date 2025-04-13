<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Missions') }}
            <x-breadcrumb>
                <x-breadcrumb-item label="Home" :href="route('dashboard')" icon-none />
                <x-breadcrumb-item label="Missions" :href="route('missions.index')" />
                <x-breadcrumb-item label="Create" />
            </x-breadcrumb>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="container">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight pb-4">
                    {{ __('Create Mission') }}
                </h2>


                <form method="POST" action="{{ route('missions.store') }}">
                    @csrf

                    <div class="mb-3">
                        <!-- <label for="goal" class="form-label">Goal</label> -->
                        <!-- <input type="text" class="form-control" id="goal" name="goal" required> -->
                        <x-tc-input name="goal" label="Goal" required />
                    </div>

                    <div class="mb-3">
                        <!-- <label for="place" class="form-label">Place</label> -->
                        <!-- <input type="text" class="form-control" id="place" name="place" required> -->
                        <x-tc-input name="place" label="Place" required />
                    </div>

                    <div class="mb-3">
                        <!-- <label for="start_date" class="form-label">Start Date</label> -->
                        <!-- <input type="date" class="form-control" id="start_date" name="start_date" required> -->
                        <x-tc-input name="start_date" label="Start Date" type="date" required />
                    </div>

                    <div class="mb-3">
                        <!-- <label for="end_date" class="form-label">End Date</label> -->
                        <!-- <input type="date" class="form-control" id="end_date" name="end_date" required> -->
                        <x-tc-input name="end_date" label="End Date" type="date" required />
                    </div>

                    <div class="mb-3">
                        <!-- <label for="signature_date" class="form-label">Signature Date</label> -->
                        <!-- <input type="date" class="form-control" id="signature_date" name="signature_date" required> -->
                        <x-tc-input name="signature_date" label="Signature Date" type="date" required />
                    </div>

                    <div class="mb-3">
                        <x-tc-select name="people_id[]" label="Assign People" :options="$people" wire:model="people_id" hint="Multi people can select" multiple required />

                    </div>


                    <x-tc-button type="submit">Create Mission</x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>