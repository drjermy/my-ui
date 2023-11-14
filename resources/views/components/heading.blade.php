@props([
    'heading',
    'subheading' => null,
    'meta' => null,
    'actions' => null,
])

@php
    if (isset($heading)) {
        $slot = $heading;
    }

    if (isset($subheading)) {
        $meta = $subheading;
    }
@endphp

<div class="mb-6">
    <div class="lg:flex lg:items-center lg:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-800 sm:text-3xl sm:leading-9 sm:truncate">
                {{ $slot }}
            </h2>
            @if ($meta)
                <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap">
                    {{ $meta }}
                </div>
            @endif
        </div>
        @if ($actions)
            <div class="mt-5 flex lg:mt-0 lg:ml-4">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>