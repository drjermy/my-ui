@props([
    'style' => 'primary', // primary, secondary, soft
    'size' => 'md', // xs, sm, md, lg, xl
    'weight' => 'normal', // light, normal, medium, solid
    'rounded' => false, // default, rounded
    'circular' => false,
    'icon' => null,
    'disabled' => null,
    'text' => null,
])

@php
    $boolAttributesList = [
        'weight' => ['light', 'solid']
    ];

    foreach($boolAttributesList as $variableName => $boolAttributes) {
        foreach ($boolAttributes as $boolAttribute) {
            if (isset($attributes[$boolAttribute])) {
                $$variableName = $boolAttribute;
            }
        }
    }

    $boolAttributeSet = [
        'add' => ['style' => 'primary', 'text' => 'Add', 'icon' => 'plus'],
    ];

    foreach($boolAttributeSet as $boolAttribute => $declarations) {
        if (isset($attributes[$boolAttribute])) {
            foreach($declarations as $variableName => $variableValue) {
                $$variableName = $variableValue;
            }
        }
    }

    $iconWeight = match ($weight) {
        'semibold' => 'regular',
        'medium' => 'light',
        'light' => 'light',
        default => 'light',
    };

    $rounded = $rounded ? 'rounded' : 'default';

    if (isset($text)) {
        $slot = $text;
    }

    $styleCSS = [
        'primary' => 'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2',
        'secondary' => 'bg-white text-gray-900 ring-gray-300 hover:bg-gray-50 ring-1 ring-inset',
        'soft' => 'bg-indigo-50 text-indigo-600 hover:bg-indigo-100',
        'danger' => 'bg-red-600 text-white border-transparent hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-300'
    ][$style];

    $shapeCSS = [
        'default' => [
            'xs' => 'rounded',
            'sm' => 'rounded',
            'md' => 'rounded-md',
            'lg' => 'rounded-md',
            'xl' => 'rounded-md',
        ],
        'rounded' => [
            'xs' => 'rounded-full',
            'sm' => 'rounded-full',
            'md' => 'rounded-full',
            'lg' => 'rounded-full',
            'xl' => 'rounded-full',
        ],
    ][$rounded][$size];

    $sizeCSS = [
        'xs' => 'px-2.5 py-1 text-xs',
        'sm' => 'px-2.5 py-1 text-sm',
        'md' => 'px-3 py-1.5 text-sm',
        'lg' => 'px-3.5 py-2 text-sm',
        'xl' => 'px-4 py-2.5 text-sm',
    ][$size];

    if ($circular) {
        $shapeCSS = 'rounded-full';
        $sizeCSS = [
            'xs' => 'p-1',
            'sm' => 'p-1',
            'md' => 'p-1.5',
            'lg' => 'p-2',
            'xl' => 'p-2.5',
        ][$size];
    }

    $genericCSS = match($weight) {
        'light' => 'font-light',
        'solid' => 'font-semibold',
        default => 'font-medium',
    };

    $genericCSS .= ' shadow-sm';

    $buttonCSS = "$styleCSS $shapeCSS $sizeCSS $genericCSS";

    if ($disabled == 'disabled') {
        $buttonCSS .= " opacity-50 cursor-not-allowed";
    }

    $buttonCSS = trim(str_replace('  ', ' ', $buttonCSS));
@endphp

<button type="button" {{ $attributes->merge(['class' => $buttonCSS]) }} @if($disabled)disabled="disabled"@endif>
    @if ($circular)
        <div class="h-5 w-5 flex justify-center items-center">
            <x-ui::icon :icon="$icon" />
        </div>
    @else
        @if ($icon)
            <x-ui::icon :weight="$iconWeight" :icon="$icon" class="pr-2" />
        @endif
        {{ $slot }}
    @endif
</button>