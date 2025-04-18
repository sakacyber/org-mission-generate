@props(['model', 'id' => null, 'maxWidth' => '2xl'])

@php
    $id = $id ?? md5($model);

    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth];
@endphp

<div x-data x-show="{{ $model }}" x-on:close.stop="{{ $model }} = false"
    x-on:keydown.escape.window="{{ $model }} = false" x-cloak id="{{ $id }}"
    class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0">
    <div x-show="{{ $model }}" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-500 dark:bg-gray-900 opacity-75" @click="{{ $model }} = false">
    </div>

    <div x-show="{{ $model }}" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
        x-trap.inert.noscroll="{{ $model }}">
        {{ $slot }}
    </div>
</div>
