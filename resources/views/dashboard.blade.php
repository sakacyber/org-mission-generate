<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">

                <div id="app" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-6">

                    <div class="flex flex-col grid-cols-1 space-y-4">
                        <x-tc-stat icon="users" title="Total users" number="10,500" />
                        <x-tc-stat icon="users" title="Total users" number="10,500" tooltip increase="12.5%" />
                        <x-tc-stat icon="users" title="Total users" number="10,500" tooltip="User decrease"
                            decrease="5%" />
                    </div>

                    <div class="flex flex-col grid-cols-1 space-y-4">
                        <x-tc-stat icon-right="users" title="Total users" number="10,500" class="w-80" primary />
                        <x-tc-stat icon-right="users" title="Total users" number="10,500" class="w-80" amber />
                        <x-tc-stat icon-right="users" title="Total users" number="10,500" class="w-80" rose />
                    </div>
                </div>


            </div>

            <div class="bg-white dark:bg-gray-800 mt-6 p-6 rounded-lg text-sm">

            </div>

        </div>
    </div>
</x-app-layout>