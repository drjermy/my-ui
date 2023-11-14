<?php

it('renders a button', function () {
    $html = $this->render('<x-ui::button>Test Button</x-ui::button>');

    $classes = 'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 rounded-md px-3 py-1.5 text-sm font-medium shadow-sm';
    $expected = <<<HTML
        <button type="button" class="$classes"> Test Button </button>
        HTML;

    expect($html)->toBe($expected);
});

it('sets button text using an attribute', function () {
    $html = $this->render('<x-ui::button text="Test Button" />');

    $classes = 'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 rounded-md px-3 py-1.5 text-sm font-medium shadow-sm';
    $expected = <<<HTML
        <button type="button" class="$classes"> Test Button </button>
        HTML;

    expect($html)->toBe($expected);
});

it('renders the correct style', function ($style, $classes) {
    $html = $this->render("<x-ui::button style=\"$style\">Test Button</x-ui::button>");

    $expected = <<<HTML
        <button type="button" class="$classes"> Test Button </button>
        HTML;

    expect($html)->toBe($expected);

})->with([
    ['primary', 'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 rounded-md px-3 py-1.5 text-sm font-medium shadow-sm'],
    ['secondary', 'bg-white text-gray-900 ring-gray-300 hover:bg-gray-50 ring-1 ring-inset rounded-md px-3 py-1.5 text-sm font-medium shadow-sm'],
    ['soft', 'bg-indigo-50 text-indigo-600 hover:bg-indigo-100 rounded-md px-3 py-1.5 text-sm font-medium shadow-sm'],
    ['danger', 'bg-red-600 text-white border-transparent hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-300 rounded-md px-3 py-1.5 text-sm font-medium shadow-sm'],
]);

it('has different sizes', function ($size, $classes) {

    $html = $this->render("<x-ui::button size=\"$size\">Test Button</x-ui::button>");

    $classes = "bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 $classes font-medium shadow-sm";
    $expected = <<<HTML
        <button type="button" class="$classes"> Test Button </button>
        HTML;

    expect($html)->toBe($expected);

})->with([
    ['xs', 'rounded px-2.5 py-1 text-xs'],
    ['sm', 'rounded px-2.5 py-1 text-sm'],
    ['md', 'rounded-md px-3 py-1.5 text-sm'],
    ['lg', 'rounded-md px-3.5 py-2 text-sm'],
    ['xl', 'rounded-md px-4 py-2.5 text-sm'],
]);

it('can be rounded', function ($size, $classes) {

    $html = $this->render("<x-ui::button rounded size=\"$size\">Test Button</x-ui::button>");

    $classes = "bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 $classes font-medium shadow-sm";
    $expected = <<<HTML
        <button type="button" class="$classes"> Test Button </button>
        HTML;

    expect($html)->toBe($expected);

})->with([
    ['xs', 'rounded-full px-2.5 py-1 text-xs'],
    ['sm', 'rounded-full px-2.5 py-1 text-sm'],
    ['md', 'rounded-full px-3 py-1.5 text-sm'],
    ['lg', 'rounded-full px-3.5 py-2 text-sm'],
    ['xl', 'rounded-full px-4 py-2.5 text-sm'],
]);

it('can be circular', function ($size, $classes, $icon) {

    $html = $this->render("<x-ui::button circular size=\"$size\" icon=\"{$icon}\" />");

    $expected = <<<HTML
        <button type="button" class="bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 rounded-full $classes font-medium shadow-sm">
            <div class="h-5 w-5 flex justify-center items-center">
                <span><i class="fa-regular fa-$icon"></i></span>
            </div>
        </button>
        HTML;

    expect($html)->toBe($expected);

})->with([
    ['xs', 'p-1'],
    ['sm', 'p-1'],
    ['md', 'p-1.5'],
    ['lg', 'p-2'],
    ['xl', 'p-2.5'],
])->with(['plus', 'user']);

it('can be disabled', function () {
    $html = $this->render('<x-ui::button disabled>Test Button</x-ui::button>');

    $classes = 'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 rounded-md px-3 py-1.5 text-sm font-medium shadow-sm opacity-50 cursor-not-allowed';
    $expected = <<<HTML
        <button type="button" class="$classes" disabled="disabled"> Test Button </button>
        HTML;

    expect($html)->toBe($expected);
});