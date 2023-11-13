@props([
    'type' => 'text',
    'label' => null,
    'placeholder'=> null,
    'name' => null,
    'id' => null,
    'add_clearing' => true,
    'dusk' => null,
    'error' => null,
])

@php
    if (is_null($name)) {
        if (isset($attributes['wire:model'])) {
            $name = $attributes['wire:model'];
        } else {
            $name = 'input-'.uniqid();
        }
    }

    $name = preg_replace('/[\s-]/', '_', $name);

    $id = $id ?: $name;

    if (isset($placeholder)) {
        $placeholder = is_string($placeholder) ? $placeholder : $label;
    }

    if (isset($dusk)) {
        $dusk = is_string($dusk) ? $dusk : 'input-'.$name;
    }

    $wrapperBaseCSS = 'relative w-full';
    $wrapperMarginCSS = $add_clearing ? 'mb-3' : '';
    $wrapperCSS = "$wrapperBaseCSS $wrapperMarginCSS";

    $inputCSS = "block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6";
    $labelCSS = "block text-sm font-medium leading-6 text-gray-900";
@endphp

<div class="{{ $wrapperCSS }}" @isset($dusk) dusk="{{ $dusk }}" @endisset>
    @if($label)
        <label for="{{ $name }}" class="{{ $labelCSS }}">{{ $label }}</label>
    @endif

    <div @if($label) class="mt-2" @endif>
        <input {{ $attributes->merge(['class' => $inputCSS]) }}
               type="{{ $type }}"
               name="{{ $name }}"
               id="{{ $id }}"
               @isset($placeholder) placeholder="{{ $placeholder }}" @endisset>
    </div>

    <x-ui::error :name="$name" :error="$error" />
</div>
