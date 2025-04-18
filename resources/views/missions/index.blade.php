<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Missions') }}
            <x-tc-breadcrumb>
                <x-tc-breadcrumb-item label="Home" :href="route('dashboard')" icon-none />
                <x-tc-breadcrumb-item label="Missions" />
            </x-tc-breadcrumb>
        </h2>

    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div x-data="{ showModal: false, deleteUrl: '', itemName: '' }" class="container">
                @if (session('success'))
                    <x-toast type="success" :message="session('success')" />
                @endif

                @if (session('error'))
                    <x-toast type="error" :message="session('error')" />
                @endif

                <div class="p-4 justify-end flex">
                    <x-tc-button><a href="{{ route('missions.create')}}">Add New Mission</a></x-tc-button>
                </div>

                <x-tc-card class="max-w bg-white dark:bg-gray-800">
                    <x-tc-table :paginate="$missions" searchable hoverable>
                        <x-slot:heading>
                            <x-tc-th label="#" />
                            <x-tc-th label="Goal" />
                            <x-tc-th label="Place" />
                            <x-tc-th label="People" />
                            <x-tc-th label="Date" class="text-center" />
                            <x-tc-th label="Action" />
                        </x-slot:heading>

                        @forelse ($missions as $mission)
                                                <x-tc-tr>
                                                    <x-tc-td :label="$mission->id" />
                                                    <x-tc-td :label="$mission->goal" />
                                                    <x-tc-td :label="$mission->place" />

                                                    <x-tc-td>
                                                        @foreach($mission->people->take(2) as $person)
                                                            <li>{{ $person->name }}</li>
                                                        @endforeach
                                                        @if($mission->people->count() > 2)
                                                            <li class="italic text-gray-500">+{{ $mission->people->count() - 2 }} more</li>
                                                        @endif
                                                    </x-tc-td>
                                                    <x-tc-td class="text-center">{{ $mission->start_date }}
                                                        <p>{{ $mission->end_date }}</p>
                                                        </x-td>
                                                        <x-tc-td class="space-x-2">
                                                            <x-dropdown w-80>
                                                                @slot('trigger')
                                                                <x-tc-button icon="ellipsis-vertical" flat gray circle />
                                                                @endslot

                                                                <x-tc-dropdown-item label="View" icon="eye" link="{{ route('missions.show', [
                                'mission' => $mission->id,
                                'page' => request('page'),
                                'search' => request('search'),
                            ]) }}" />
                                                                <x-tc-dropdown-item label="Edit" icon="pencil" link="{{ route('missions.edit', [
                                'mission' => $mission->id,
                                'page' => request('page'),
                                'search' => request('search'),
                            ]) }}" />
                                                                <x-tc-dropdown-item label="Delete" icon="trash" link="{{ route('missions.destroy', [
                                'mission' => $mission->id,
                                'page' => request('page'),
                                'search' => request('search'),
                            ]) }}" />

                                                            </x-dropdown>


                                                            </x-td>

                                                            </x-tr>
                        @empty
                            <x-tc-not-found />
                        @endforelse
                                    </x-table>
                                    </x-card>


                                    <x-tc-button label="MD" x-on:click="$openModal('blur-md')" primary />

                                    <x-modal name="blur-md" blur="md">
                                        <x-card title="Blur SM">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </x-card>
                                    </x-modal>


                                    <!-- delete modal -->
                                    <x-modal2 :model="'showModal'">
                                        <div class="p-6 text-center">
                                            <h2 class="text-lg font-semibold">Confirm Delete</h2>
                                            <p class="mb-4 text-gray-500">
                                                Are you sure you want to delete <strong x-text="itemName"></strong>?
                                            </p>

                                            <div class="flex justify-center gap-4">
                                                <button @click="showModal = false"
                                                    class="btn btn-secondary">Cancel</button>

                                                <form :action="deleteUrl" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-button type="submit" label="Delete" icon="trash" red />
                                                </form>
                                            </div>
                                        </div>
                                    </x-modal2>



                                    <!-- div container                                                         -->
            </div>

        </div>
    </div>
</x-app-layout>