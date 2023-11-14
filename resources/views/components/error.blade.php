@props([
    'name',
    'error' => null,
])

@php
    if (isset($errors)) {
        $error = $errors->first($name);
    }
@endphp

@if($error)
    <div id="{{ $name }}-error" class="text-red-500 text-xs pt-2 px-1">
        {{ $error }}
    </div>
@endif