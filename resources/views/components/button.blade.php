@php use MyUi\Support\Attr; @endphp
@props([
    'style' => 'primary', // primary, secondary, soft
    'size' => 'md', // xs, sm, md, lg, xl
    'weight' => 'normal', // light, normal, medium, solid
    'rounded' => false, // default, rounded
    'circular' => false,
    'icon' => null,
    'disabled' => null,
    'text' => null,
    'href' => null,
])

@php
    $boolAttributesList = [
        'style' => ['primary', 'secondary', 'soft', 'danger']
    ];

    foreach($boolAttributesList as $variableName => $boolAttributes) {
        foreach ($boolAttributes as $boolAttribute) {
            if (isset($attributes[$boolAttribute])) {
                $$variableName = $boolAttribute;
            }
            unset($attributes[$boolAttribute]);
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
            unset($attributes[$boolAttribute]);
        }
    }

    $rounded = $rounded ? 'rounded' : 'default';

    if (isset($text)) {
        $slot = $text;
    }

    $buttonCSS = (new Attr())
        ->match($style, [
            'primary' => 'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2',
            'secondary' => 'bg-white text-gray-900 ring-gray-300 hover:bg-gray-50 ring-1 ring-inset',
            'soft' => 'bg-indigo-50 text-indigo-600 hover:bg-indigo-100',
            'danger' => 'bg-red-600 text-white border-transparent hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-300'
        ], 'primary')
        ->match($size, [
            'xs' => 'px-2.5 py-1',
            'sm' => 'px-2.5 py-1',
            'md' => 'px-3 py-1.5',
            'lg' => 'px-3.5 py-2',
            'xl' => 'px-4 py-2.5',
        ], 'md')
        ->match($size, [
            'xs' => 'p-1',
            'sm' => 'p-1',
            'md' => 'p-1.5',
            'lg' => 'p-2',
            'xl' => 'p-2.5',
        ], 'md', $circular === true)
        ->add('text-sm')
        ->add('text-xs', $size === 'xs')
        ->match($weight, [
            'light' => 'font-light',
            'medium' => 'font-medium',
            'solid' => 'font-semibold',
        ], 'medium')
        ->add('rounded-md')
        ->add('rounded', $size === 'xs' || $size === 'sm')
        ->add('rounded-full', $rounded === 'rounded' || $circular)
        ->add('shadow-sm')
        ->add('opacity-50 cursor-not-allowed', $disabled == 'disabled')
        ->merge();

    $iconWeight = match ($weight) {
        'semibold' => 'regular',
        default => 'light',
    };

    $tag = isset($href) ? 'a' : 'button';
    $defn = isset($href) ? "href=\"$href\"" : '';
@endphp

<{{ $tag }} type="button" {!! $defn !!} {{ $attributes->merge(['class' => $buttonCSS]) }} @if($disabled)disabled="disabled"@endif>
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
</{{ $tag }}>