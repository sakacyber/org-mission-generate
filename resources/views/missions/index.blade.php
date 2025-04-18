<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ $appTitle }}
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
                    <x-tc-button><a href="{{ route('missions.create')}}">Add New {{ $appTitle }}</a></x-tc-button>
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
                                                    <x-tc-td class="text-center">
                                                        <li>➡️{{ formatDate($mission->start_date) }}</li>
                                                        <li>⬅️{{ formatDate($mission->end_date) }}</li>
                                                    </x-tc-td>
                                                    <x-tc-td>
                                                        <x-dropdown position="left">
                                                            @slot('trigger')
                                                            <x-tc-button icon="ellipsis-vertical" flat gray circle />
                                                            @endslot

                                                            <x-dropdown.item label="View" icon="eye" href="{{ route('missions.show', [
                                'mission' => $mission,
                                'page' => request('page'),
                                'search' => request('search'),
                            ]) }}" />
                                                            <x-dropdown.item label="Edit" icon="pencil" href="{{ route('missions.edit', [
                                'mission' => $mission,
                                'page' => request('page'),
                                'search' => request('search'),
                            ]) }}" />
                                                            <x-dropdown.item label="Delete" icon="trash" @click="
                                                                                                                    deleteUrl = '{{ route('missions.destroy', $mission) }}';
                                                                                                                    showModal = true;
                                                                                                                    itemName = '{{ $mission->id }}';
                                                                                                                " />

                                                        </x-dropdown>


                                                    </x-tc-td>

                                                </x-tc-tr>
                        @empty
                            <x-tc-not-found />
                        @endforelse
                    </x-tc-table>
                </x-tc-card>


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
                            Are you sure you want to delete {{$appTitle}} Id <strong x-text="itemName"></strong>?
                        </p>

                        <div class="flex justify-center gap-4">
                            <x-button @click="showModal = false" label="Cancel" gray/>

                            <form :action="deleteUrl" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit" label="Delete" icon="trash" red />
                            </form>
                        </div>
                    </div>
                </x-modal2>



                <!-- div container -->
            </div>

        </div>
    </div>
</x-app-layout>