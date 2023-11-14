<?php

it('renders a heading', function () {
    $html = $this->render('<x-ui::heading heading="Test" />');

    $expected = <<<'HTML'
        <div class="mb-6">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-800 sm:text-3xl sm:leading-9 sm:truncate">
                        Test 
                    </h2>
                </div>
            </div>
        </div>
        HTML;

    expect($html)->toBe($expected);
});

it('renders a heading using the slot', function () {
    $html = $this->render('<x-ui::heading>Test</x-ui::heading>');

    $expected = <<<'HTML'
        <div class="mb-6">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-800 sm:text-3xl sm:leading-9 sm:truncate">
                        Test 
                    </h2>
                </div>
            </div>
        </div>
        HTML;

    expect($html)->toBe($expected);
});

it('renders some actions', function () {
    $render = <<<'HTML'
        <x-ui::heading heading="Test">
            <x-slot:actions>
                <button>Action</button>
            </x-slot:actions>
        </x-ui::heading>
        HTML;

    $html = $this->render($render);

    $expected = <<<'HTML'
        <div class="mb-6">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-800 sm:text-3xl sm:leading-9 sm:truncate">
                        Test 
                    </h2>
                </div>
                <div class="mt-5 flex lg:mt-0 lg:ml-4">
                    <button>Action</button>
                </div>
            </div>
        </div>
        HTML;

    expect($html)->toBe($expected);
});

it('renders some meta', function () {
    $render = <<<'HTML'
        <x-ui::heading heading="Test">
            <x-slot:meta>
                <div>some text</div>
            </x-slot:meta>
        </x-ui::heading>
        HTML;

    $html = $this->render($render);

    $expected = <<<'HTML'
        <div class="mb-6">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-800 sm:text-3xl sm:leading-9 sm:truncate">
                        Test 
                    </h2>
                    <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap">
                        <div>some text</div>
                    </div>
                </div>
            </div>
        </div>
        HTML;

    expect($html)->toBe($expected);
});

it('renders subheading as meta', function () {
    $render = <<<'HTML'
        <x-ui::heading heading="Test" subheading="This is some meta" />
        HTML;

    $html = $this->render($render);

    $expected = <<<'HTML'
        <div class="mb-6">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-800 sm:text-3xl sm:leading-9 sm:truncate">
                        Test 
                    </h2>
                    <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap"> This is some meta </div>
                </div>
            </div>
        </div>
        HTML;

    expect($html)->toBe($expected);
});
