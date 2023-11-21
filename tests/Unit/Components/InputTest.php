<?php

use Illuminate\Support\MessageBag;

it('renders an input', function () {
    $html = $this->render('<x-ui::input />');

    expect($html)
        ->toHaveSelector('input')
        ->toHaveSelectorWithAttributeValue('input', 'type', 'text')
        ->not->toHaveSelector('label')
        ->not->toHaveSelectorWithAttribute('div', 'dusk')
        ->not->toHaveSelectorWithAttribute('input', 'placeholder');
});

describe('different types', function () {
    it('allows type to be changed', function () {
        $html = $this->render('<x-ui::input type="hidden" />');

        expect($html)->toHaveSelectorWithAttributeValue('input', 'type', 'hidden');
    });
});

describe('name and id', function () {
    it('renders a name', function () {
        $html = $this->render('<x-ui::input name="Test" />');

        expect($html)->toHaveSelectorWithAttributeValue('input', 'name', 'Test');
    });

    it('autogenerates a name and id', function () {
        $html = $this->render('<x-ui::input />');

        expect($html)
            ->toHaveSelectorWithAttributeMatching('input', 'name', '/input_.{13}/')
            ->toHaveSelectorWithAttributeMatching('input', 'id', '/input_.{13}/');
    });

    it('adds id', function () {
        $html = $this->render('<x-ui::input id="input-1" />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('input', 'id', 'input-1');
    });

    it('autogenerates name from wire:model', function () {
        $html = $this->render('<x-ui::input wire:model="title" />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('input', 'name', 'title')
            ->toHaveSelectorWithAttributeValue('input', 'id', 'title');
    });

    it('autogenerates name from wire:model.live', function () {
        $html = $this->render('<x-ui::input wire:model.live="title" />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('input', 'name', 'title')
            ->toHaveSelectorWithAttributeValue('input', 'id', 'title');
    });
});

describe('label and placeholder', function () {
    it('renders a label', function () {
        $html = $this->render('<x-ui::input label="Test" />');

        expect($html)
            ->toHaveSelectorWithValue('label', 'Test')
            ->not->toHaveSelectorWithAttribute('div', 'dusk')
            ->not->toHaveSelectorWithAttribute('input', 'placeholder');
    });

    it('has a label that matches the input', function () {
        $html = $this->render('<x-ui::input name="tester" label="Test" />');

        expect($html)
            ->toHaveSelectorWithValue('label', 'Test')
            ->toHaveSelectorWithAttributeValue('label', 'for', 'tester');
    });

    it('renders a placeholder', function () {
        $html = $this->render('<x-ui::input placeholder="Test" />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('input', 'placeholder', 'Test')
            ->not->toHaveSelectorWithAttribute('div', 'dusk')
            ->not->toHaveSelector('label');
    });

    it('can have different label and placeholder', function () {
        $html = $this->render('<x-ui::input label="Last" placeholder="Test" />');

        expect($html)
            ->toHaveSelectorWithAttribute('input', 'placeholder')
            ->toHaveSelectorWithValue('label', 'Last')
            ->not->toHaveSelectorWithAttribute('div', 'dusk');
    });

    it('autogenerates a placeholder from label', function () {
        $html = $this->render('<x-ui::input label="Tester" placeholder />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('input', 'placeholder', 'Tester');
    });
});

describe('dusk', function () {
    it('adds dusk', function () {
        $html = $this->render('<x-ui::input dusk="Dusk" />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('div', 'dusk', 'Dusk');
    });

    it('autogenerates dusk from name', function () {
        $html = $this->render('<x-ui::input name="test" dusk />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('div', 'dusk', 'input-test');
    });

    it('renders different dusk and name', function () {
        $html = $this->render('<x-ui::input name="test" dusk="another" />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('div', 'dusk', 'another');
    });
});

describe('errors', function () {
    it('renders errors', function () {
        $html = $this->render('<x-ui::input name="test" error="Required" />');

        expect($html)
            ->toHaveSelectorWithValue('#test-error', 'Required');
    });

    it('renders a specific error from the error bag', function () {

        $errors = new MessageBag();
        $errors->add('test', 'Required');

        $html = $this->render('<x-ui::input name="test" :errors="$errors" />', ['errors' => $errors]);

        expect($html)
            ->toHaveSelectorWithValue('#test-error', 'Required');
    });

    it('overwrites the a specific error from the error bag', function () {

        $errors = new MessageBag();
        $errors->add('test', 'Required');

        $html = $this->render('<x-ui::input name="test" :errors="$errors" error="Another" />', ['errors' => $errors]);

        expect($html)
            ->toHaveSelectorWithValue('#test-error', 'Another');
    });
});
