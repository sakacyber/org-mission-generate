@props(['type' => 'success', 'message', 'title'])

@php
    // Define background styles based on toast type
    $styles = [
        'success' => 'bg-green-300',
        'error' => 'bg-red-300',
        'info' => 'bg-blue-300',
        'warning' => 'bg-yellow-300',
    ];

    // Define icons based on toast type
    $icons = [
        'success' => '<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5 13l4 4L19 7"/>
                          </svg>',

        'error' => '<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"/>
                        </svg>',

        'info' => '<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M12 20h.01"/>
                        </svg>',

        'warning' => '<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8v4m0 4h.01M12 4L4 20h16L12 4z"/>
                          </svg>',
    ];
@endphp

<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition
    class="fixed top-5 right-5 z-50 flex items-center gap-3 px-6 py-3 rounded-lg shadow-lg text-white {{ $styles[$type] ?? 'bg-gray-800' }}">
    <!-- Circle Icon -->
    <div class="shrink-0 p-2 bg-white rounded-full flex items-center justify-center">
        {!! $icons[$type] ?? '' !!}
    </div>

    <!-- Message Content -->
    <div class="ml-3">
        <!-- Title -->
        <div class="font-semibold text-lg">
            {{ $title ?? ucfirst($type) }}
        </div>

        <!-- Description -->
        <div class="text-sm font-medium mt-1">
            {{ $message }}
        </div>
    </div>

    <!-- Close Button -->
    <button x-on:click="show = false" class="ml-4 text-white hover:text-gray-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
