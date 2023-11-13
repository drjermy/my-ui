@props([
    'icon',
    'weight' => 'regular',
    'sr' => null,

    'light' => null,
    'duotone' => null,

    'fw' => null,
])

@php
    // Set weight, e.g. fa-regular
    $weightClass = 'fa-'.match (true) {
        $light => 'light',
        $duotone => 'duotone',
        default => $weight,
    };

    // Set icon, e.g. fa-times
    $iconClass = "fa-{$icon}";

    if(isset($fw)) {
        $additionalClasses = 'fa-fw';
    }

    // Final template vars
    $srOnly = $sr;
    $class = "{$weightClass} {$iconClass} {$additionalClasses}";
@endphp

<span {{ $attributes }}>
    @isset ($srOnly)
        <span class="sr-only">{{ $srOnly }}</span>
    @endisset
    <i class="{{ $class }}"></i>
</span>