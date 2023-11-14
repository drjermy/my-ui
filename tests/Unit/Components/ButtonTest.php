<?php

it('renders a button', function () {
    $html = $this->render('<x-ui::button>Test Button</x-ui::button>');

    $classes = 'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 px-3 py-1.5 text-sm font-medium rounded-md shadow-sm';
    $expected = <<<HTML
        <button type="button" class="$classes"> Test Button </button>
        HTML;

    expect($html)->toBe($expected);
});

it('sets button text using an attribute', function () {
    $html = $this->render('<x-ui::button text="Test Button" />');

    $classes = 'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 px-3 py-1.5 text-sm font-medium rounded-md shadow-sm';
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

})->with('styles');

it('has different sizes', function ($size, $classes) {

    $html = $this->render("<x-ui::button size=\"$size\">Test Button</x-ui::button>");

    $classes = "bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 $classes shadow-sm";
    $expected = <<<HTML
        <button type="button" class="$classes"> Test Button </button>
        HTML;

    expect($html)->toBe($expected);

})->with([
    ['xs', 'px-2.5 py-1 text-xs font-medium rounded'],
    ['sm', 'px-2.5 py-1 text-sm font-medium rounded'],
    ['md', 'px-3 py-1.5 text-sm font-medium rounded-md'],
    ['lg', 'px-3.5 py-2 text-sm font-medium rounded-md'],
    ['xl', 'px-4 py-2.5 text-sm font-medium rounded-md'],
]);

it('can be rounded', function ($size, $classes) {

    $html = $this->render("<x-ui::button rounded size=\"$size\">Test Button</x-ui::button>");

    $classes = "bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 $classes font-medium rounded-full shadow-sm";
    $expected = <<<HTML
        <button type="button" class="$classes"> Test Button </button>
        HTML;

    expect($html)->toBe($expected);

})->with([
    ['xs', 'px-2.5 py-1 text-xs'],
    ['sm', 'px-2.5 py-1 text-sm'],
    ['md', 'px-3 py-1.5 text-sm'],
    ['lg', 'px-3.5 py-2 text-sm'],
    ['xl', 'px-4 py-2.5 text-sm'],
]);

it('can be circular', function ($size, $classes, $icon) {

    $html = $this->render("<x-ui::button circular size=\"$size\" icon=\"{$icon}\" />");

    $expected = <<<HTML
        <button type="button" class="bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 $classes font-medium rounded-full shadow-sm">
            <div class="h-5 w-5 flex justify-center items-center">
                <span><i class="fa-regular fa-$icon"></i></span>
            </div>
        </button>
        HTML;

    expect($html)->toBe($expected);

})->with([
    ['xs', 'p-1 text-xs'],
    ['sm', 'p-1 text-sm'],
    ['md', 'p-1.5 text-sm'],
    ['lg', 'p-2 text-sm'],
    ['xl', 'p-2.5 text-sm'],
])->with(['plus', 'user']);

it('can be disabled', function () {
    $html = $this->render('<x-ui::button disabled>Test Button</x-ui::button>');

    $classes = 'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 px-3 py-1.5 text-sm font-medium rounded-md shadow-sm opacity-50 cursor-not-allowed';
    $expected = <<<HTML
        <button type="button" class="$classes" disabled="disabled"> Test Button </button>
        HTML;

    expect($html)->toBe($expected);
});

describe('boolean defaults', function () {

    it('allows boolean attributes to define style', function ($style, $classes) {
        $html = $this->render("<x-ui::button $style>Test Button</x-ui::button>");

        $expected = <<<HTML
            <button type="button" class="$classes"> Test Button </button>
            HTML;

        expect($html)->toBe($expected);
    })->with('styles');

    it('allows boolean attributes to define button', function ($type, $classes, $text, $icon) {
        $html = $this->render("<x-ui::button $type />");

        $expected = <<<HTML
            <button type="button" class="$classes">
                <span class="pr-2"><i class="$icon"></i></span>
                $text 
            </button>
            HTML;

        expect($html)->toBe($expected);
    })->with([
        ['add', 'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 px-3 py-1.5 text-sm font-medium rounded-md shadow-sm', 'Add', 'fa-light fa-plus'],
    ]);
});

describe('anchor', function () {
    it('can render as an anchor with href rather than a button', function () {
        $href = 'https://radiopaedia.org/articles';
        $html = $this->render("<x-ui::button href=\"$href\">Test Button</x-ui::button>");

        $classes = 'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 px-3 py-1.5 text-sm font-medium rounded-md shadow-sm';
        $expected = <<<HTML
            <a href="$href" class="$classes"> Test Button </a>
            HTML;

        expect($html)->toBe($expected);
    });
});

dataset('styles', [
    ['primary', 'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 px-3 py-1.5 text-sm font-medium rounded-md shadow-sm'],
    ['secondary', 'bg-white text-gray-900 ring-gray-300 hover:bg-gray-50 ring-1 ring-inset px-3 py-1.5 text-sm font-medium rounded-md shadow-sm'],
    ['soft', 'bg-indigo-50 text-indigo-600 hover:bg-indigo-100 px-3 py-1.5 text-sm font-medium rounded-md shadow-sm'],
    ['danger', 'bg-red-600 text-white border-transparent hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-300 px-3 py-1.5 text-sm font-medium rounded-md shadow-sm'],
]);
