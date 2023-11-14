<?php

use MyUi\Support\Attr;

it('adds attributes and extract a string', function () {
    $class = new Attr();
    $class->add('test');

    expect((string) $class)->toBeString()->toBe('test');
});

it('adds spaces between attributes', function () {
    $class = new Attr();
    $class->add('test');
    $class->add('test2');

    expect((string) $class)->toBeString()->toBe('test test2');
});

it('trims and removes double spaces', function () {
    $class = new Attr();
    $class->add(' test ');
    $class->add(' test2 ');

    expect((string) $class)->toBeString()->toBe('test test2');
});

it('is chainable', function () {
    $class = (new Attr())->add('test')->add('test2');

    expect((string) $class)->toBeString()->toBe('test test2');
});

it('only adds if the truthy test is true', function () {
    $truth = true;
    $class = (new Attr())
        ->add('test')
        ->add('test2', false)
        ->add('test2', 'anything')
        ->add('test3', $truth);

    expect((string) $class)->toBeString()->toBe('test test2 test3');
});
