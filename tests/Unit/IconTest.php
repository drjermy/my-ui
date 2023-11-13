<?php

it('outputs an icon', function () {
    $html = $this->render('<x-ui::icon icon="times" />');

    expect($html)->toHaveSelector('i')
        ->toHaveSelector('i[class="fa-regular fa-times"]');
});

it('can alter the icon weight', function () {
    $html = $this->render('<x-ui::icon weight="light" icon="times" />');

    expect($html)->toHaveSelector('i')
        ->toHaveSelector('i[class="fa-light fa-times"]');
});

it('can alter the icon with a keyword', function ($weight, $class) {
    $html = $this->render('<x-ui::icon '.$weight.' icon="times" />');

    expect($html)->toHaveSelector('i')
        ->toHaveSelector('i[class~="fa-times"]');
})->with([
    ['light', 'fa-light'],
]);

it('outputs some screen-read text', function () {
    $html = $this->render('<x-ui::icon icon="times" sr="Close" />');

    expect($html)->toHaveSelector('i')
        ->toHaveSelector('span[class="sr-only"]', value: 'Close');
});

it('can extend the attributes of the wrapper', function () {
    $html = $this->render('<x-ui::icon icon="times" class="w-5" />');

    expect($html)->toHaveSelector('i')
        ->toHaveSelector('span[class~="w-5"]');
});
