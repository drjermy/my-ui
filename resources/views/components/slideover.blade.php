@props([
    'escapeToClose' => true,
    'widePanel' => false
])

@php
    $wrapperCSS = $widePanel ? 'sm:pl-16' : '';
    $panelCSS = $widePanel ? 'max-w-2xl' : 'max-w-md';
@endphp

<div
    {{ $attributes }}
    x-data="{ open: @entangle('showSlideOver') }"
    x-trap="open"
    x-show="open"
    x-ref="dialog"
    class="fixed inset-0 overflow-hidden"
    aria-labelledby="slide-over-title"
    @if ($escapeToClose) @keydown.window.escape="open = false" @endif
    x-cloak >

    <div class="absolute inset-0 overflow-hidden">

        <div
            @click="open = false"
            x-show="open"
            x-transition:enter="ease-in-out duration-500"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in-out duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-description="Background overlay, show/hide based on slide-over state."
            class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            aria-hidden="true" >
        </div>

        <div class="fixed top-16 inset-y-0 right-0 pl-10 max-w-full flex {{ $wrapperCSS }}">

            <div
                x-show="open"
                x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="pointer-events-auto w-screen {{ $panelCSS }}"
                x-description="Slide-over panel, show/hide based on slide-over state." >

                {{ $slot }}

            </div>

        </div>
    </div>
</div>