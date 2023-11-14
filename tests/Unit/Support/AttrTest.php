<?php

use MyUi\Support\Attr;

describe('add', function () {

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

    it('only adds if the truthy test is true', function () {
        $truth = true;
        $class = (new Attr())
            ->add('test')
            ->add('test2', false)
            ->add('test2', 'anything')
            ->add('test3', $truth);

        expect((string) $class)->toBeString()->toBe('test test2 test3');
    });

    it('is chainable', function () {
        $class = (new Attr())->add('test')->add('test2');

        expect((string) $class)->toBeString()->toBe('test test2');
    });
});

describe('match', function () {
    it('adds attributes from a matching array key', function () {
        $classes = [
            'test' => 'testing attrs',
            'test2' => 'another set',
        ];

        $class = new Attr();
        $class->match('test', $classes);

        expect((string) $class)->toBeString()->toBe('testing attrs');
    });

    it('adds a default match', function () {
        $classes = [
            'test' => 'testing attrs',
            'test2' => 'another set',
        ];

        $class = new Attr();
        $class->match('none', $classes, 'test2');

        expect((string) $class)->toBeString()->toBe('another set');
    });

    it('does not duplicate a default match', function () {
        $classes = [
            'test' => 'testing attrs',
            'test2' => 'another set',
        ];

        $class = new Attr();
        $class->match('test2', $classes, 'test2');

        expect((string) $class)->toBeString()->toBe('another set');
    });

    it('only uses a default match when the key does not exist', function () {
        $classes = [
            'test' => 'testing attrs',
            'test2' => 'another set',
        ];

        $class = new Attr();
        $class->match('test', $classes, 'test2');

        expect((string) $class)->toBeString()->toBe('testing attrs');
    });

    it('does not match if a truthy test is false', function () {
        $classes = [
            'test' => 'testing attrs',
            'test2' => 'another set',
        ];

        $class = new Attr();
        $class->match('none', $classes, 'test2', false);

        expect((string) $class)->toBeString()->toBe('');
    });

    it('is chainable', function () {
        $classes = [
            'test' => 'testing attrs',
            'test2' => 'another set',
        ];

        $class = new Attr();
        $class->match('test', $classes)->add('also');

        expect((string) $class)->toBeString()->toBe('testing attrs also');
    });
});

describe('merge', function () {
    it('merges tailwind classes', function () {
        $class = new Attr();
        $class->add('bg-indigo-600 text-white');
        $class->add('bg-red-600');
        $class->merge();

        expect((string) $class)->toBeString()->toBe('text-white bg-red-600');
    });

    it('is chainable', function () {
        $class = (new Attr())
            ->add('bg-indigo-600 text-white')
            ->add('bg-red-600')
            ->merge();

        expect((string) $class)->toBeString()->toBe('text-white bg-red-600');
    });
});
