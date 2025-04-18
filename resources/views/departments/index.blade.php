<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$appTitle}}
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
                    <x-tc-button link="{{ route('departments.create')}}">Add New {{$appTitle}}</x-tc-button>
                </div>

                <x-tc-card class="max-w">
                    <x-tc-table :paginate="$departments" searchable hoverable>
                        <x-slot:heading>
                            <x-tc-th label="#" />
                            <x-tc-th label="Name" />
                            <x-tc-th label="People" />
                            <x-tc-th label="Notes" />
                            <x-tc-th label="Created" />
                            <x-tc-th label="Action" />
                        </x-slot:heading>

                        @forelse ($departments as $dept)
                            <x-tc-tr>
                                <x-tc-td :label="$dept->id" />
                                <x-tc-td :label="$dept->name" />
                                <x-tc-td :label="$dept->people->count()" />
                                <x-tc-td :label="$dept->notes" />
                                <x-tc-td :label="$dept->created_at->format('d M Y')" />

                                <x-tc-td class="space-x-2">
                                    <x-tc-dropdown>
                                        <x-slot:trigger>
                                            <x-tc-button icon="ellipsis-vertical" flat gray circle />
                                        </x-slot:trigger>
                                        <x-tc-dropdown-item label="View" icon="eye"
                                            link="{{ route('departments.show', $dept) }}" />
                                        <x-tc-dropdown-item label="Edit" icon="pencil"
                                            link="{{ route('departments.edit', $dept) }}" />
                                        <x-tc-dropdown-item label="Delete" icon="trash" @click="
                                                                deleteUrl = '{{ route('departments.destroy', $dept->id) }}';
                                                                showModal = true;
                                                                itemName = '{{ $dept->name }}';
                                                            " />
                                    </x-tc-dropdown>
                                </x-tc-td>

                            </x-tc-tr>
                        @empty
                            <x-tc-not-found />
                        @endforelse
                    </x-tc-table>
                </x-tc-card>



                <!-- delete modal -->
                <x-modal2 :model="'showModal'">
                    <div class="p-6 text-center">
                        <h2 class="text-lg font-semibold">Confirm Delete</h2>
                        <p class="mb-4 text-gray-500">
                            Are you sure you want to delete <strong x-text="itemName"></strong>?
                        </p>

                        <div class="flex justify-center gap-4">
                            <button @click="showModal = false" class="btn btn-secondary">Cancel</button>

                            <form :action="deleteUrl" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit" label="Delete" icon="trash" red />
                            </form>
                        </div>
                    </div>
                </x-modal2>


                <x-button x-on:click="$wireui.notify({
                    icon: 'success',
                    title: 'Success Notification!',
                    description: 'This is a description.',
                })" positive>
                    Success Notification
                </x-button>


                <!-- container -->
            </div>




        </div>
    </div>
</x-app-layout>