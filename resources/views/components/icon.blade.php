@props([
    'icon',
    'weight' => 'regular',
    'sr' => null,

    'light' => null,
])

@php
    // Set weight, e.g. fa-regular
    $weightClass = 'fa-'.match (true) {
        $light => 'light',
        default => $weight,
    };

    // Set icon, e.g. fa-times
    $iconClass = "fa-{$icon}";

    // Final template vars
    $srOnly = $sr;
    $class = "{$weightClass} {$iconClass}";
@endphp

<span {{ $attributes }}>
    @isset ($srOnly)
        <span class="sr-only">{{ $srOnly }}</span>
    @endisset
    <i class="{{ $class }}" />
</span>