<?php

it('outputs an icon', function () {
    $html = $this->render('<x-ui::icon icon="times" />');

    $expected = <<<'HTML'
        <span><i class="fa-regular fa-times"></i></span>
        HTML;

    expect($html)->toBe($expected);
});

it('can alter the icon weight', function () {
    $html = $this->render('<x-ui::icon weight="light" icon="times" />');

    $expected = <<<'HTML'
        <span><i class="fa-light fa-times"></i></span>
        HTML;

    expect($html)->toBe($expected);
});

it('can set fixed-width', function () {
    $html = $this->render('<x-ui::icon icon="times" fw />');

    $expected = <<<'HTML'
        <span><i class="fa-regular fa-times fa-fw"></i></span>
        HTML;

    expect($html)->toBe($expected);
});

it('can alter the icon with a keyword', function ($weight, $class) {
    $html = $this->render('<x-ui::icon '.$weight.' icon="times" />');

    $expected = <<<HTML
        <span><i class="{$class} fa-times"></i></span>
        HTML;

    expect($html)->toBe($expected);
})->with([
    ['light', 'fa-light'],
    ['duotone', 'fa-duotone'],
]);

it('outputs some screen-read text', function () {
    $html = $this->render('<x-ui::icon icon="times" sr="Close" />');

    $expected = <<<'HTML'
        <span><span class="sr-only">Close</span><i class="fa-regular fa-times"></i></span>
        HTML;

    expect($html)->toBe($expected);
});

it('can extend the attributes of the wrapper', function () {
    $html = $this->render('<x-ui::icon icon="times" class="w-5" />');

    $expected = <<<'HTML'
        <span class="w-5"><i class="fa-regular fa-times"></i></span>
        HTML;

    expect($html)->toBe($expected);
});

it('can set weight using bool attributes', function ($attribute, $class) {
    $html = $this->render("<x-ui::icon {$attribute} icon=\"times\" />");

    $expected = <<<HTML
        <span><i class="{$class} fa-times"></i></span>
        HTML;

    expect($html)->toBe($expected);
})->with([
    ['light', 'fa-light'],
    ['regular', 'fa-regular'],
    ['duotone', 'fa-duotone'],
]);
