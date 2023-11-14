<?php

it('renders a button', function () {
    $html = $this->render('<x-ui::button>Test Button</x-ui::button>');

    expect($html)
        ->toHaveButton()
        ->toHaveButton('Test Button')
        ->toHaveButton(attr: ['type', 'button'])
        ->toHaveButton(class: 'bg-indigo-600 text-white rounded-md px-2.5 text-sm')
        ->not->toHaveButton(class: 'opacity-50 cursor-not-allowed');
});

it('sets button text', function () {
    $html = $this->render('<x-ui::button text="Test Button" />');

    expect($html)
        ->toHaveButton()
        ->toHaveButton('Test Button')
        ->toHaveButton(attr: ['type', 'button'])
        ->toHaveButton(class: 'bg-indigo-600 text-white rounded-md px-2.5 text-sm')
        ->not->toHaveButton(class: 'opacity-50 cursor-not-allowed');
});

it('has the correct colours', function ($style, $classes) {

    $html = $this->render("<x-ui::button style=\"$style\">Test Button</x-ui::button>");

    expect($html)->toHaveButton(class: $classes);

})->with([
    ['primary', 'bg-indigo-600 text-white'],
    ['secondary', 'bg-white text-gray-900'],
    ['soft', 'bg-indigo-50 text-indigo-600'],
    ['danger', 'text-white bg-red-600 border-transparent hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-300'],
]);

it('has different sizes', function ($size, $classes) {

    $html = $this->render("<x-ui::button size=\"$size\">Test Button</x-ui::button>");

    expect($html)->toHaveButton(class: $classes);

})->with([
    ['xs', 'rounded px-2 py-1 text-xs'],
    ['sm', 'rounded px-2 py-1 text-sm'],
    ['md', 'rounded-md px-2.5 py-1.5 text-sm'],
    ['lg', 'rounded-md px-3 py-2 text-sm'],
    ['xl', 'rounded-md px-3.5 py-2.5 text-sm'],
]);

it('can be rounded', function ($size, $classes) {

    $html = $this->render("<x-ui::button rounded size=\"$size\">Test Button</x-ui::button>");

    expect($html)->toHaveButton(class: $classes);

})->with([
    ['xs', 'rounded-full px-2.5 py-1 text-xs'],
    ['sm', 'rounded-full px-2.5 py-1 text-sm'],
    ['md', 'rounded-full px-3 py-1.5 text-sm'],
    ['lg', 'rounded-full px-3.5 py-2 text-sm'],
    ['xl', 'rounded-full px-4 py-2.5 text-sm'],
]);

it('can be circular', function ($size, $classes, $icon) {

    $html = $this->render("<x-ui::button circular size=\"$size\" icon=\"{$icon}\" />");

    expect($html)
        ->toHaveButton(class: $classes)
        ->toHaveSelectorWithClass('button div', 'h-5 w-5 flex')
        ->toHaveSelectorWithClass('button div i', "fa-regular fa-$icon");

})->with([
    ['xs', 'rounded-full p-1'],
    ['sm', 'rounded-full p-1'],
    ['md', 'rounded-full p-1.5'],
    ['lg', 'rounded-full p-2'],
    ['xl', 'rounded-full p-2.5'],
])->with(['plus', 'user']);

it('can be disabled', function () {
    $html = $this->render('<x-ui::button disabled>Test Button</x-ui::button>');

    expect($html)
        ->toHaveButton()
        ->toHaveButton(attr: 'disabled')
        ->toHaveButton(class: 'opacity-50 cursor-not-allowed');
});
