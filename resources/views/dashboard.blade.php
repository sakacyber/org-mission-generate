<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div id="app">
                    <mission-dashboard></mission-dashboard>

                    <x-stat icon="users" title="Total users" number="10,500" />
                    <x-stat icon="users" title="Total users" number="10,500" tooltip increase="12.5%" />
                    <x-stat icon="users" title="Total users" number="10,500" tooltip="User decrease" decrease="5%" />


                    <x-stat icon-right="users" title="Total users" number="10,500" class="w-56" primary />
                    <x-stat icon-right="users" title="Total users" number="10,500" class="w-56" amber />
                    <x-stat icon-right="users" title="Total users" number="10,500" class="w-56" rose />
                </div>

            </div>
        </div>
    </div>
</x-app-layout>