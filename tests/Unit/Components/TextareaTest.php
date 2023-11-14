<?php

it('renders a textarea', function () {
    $html = $this->render('<x-ui::textarea />');

    expect($html)
        ->toHaveSelector('textarea')
        ->toHaveSelectorWithAttributeValue('textarea', 'rows', '3')
        ->not->toHaveSelector('label')
        ->not->toHaveSelectorWithAttribute('div', 'dusk')
        ->not->toHaveSelectorWithAttribute('textarea', 'placeholder');
});

describe('name and id', function () {
    it('renders a name', function () {
        $html = $this->render('<x-ui::textarea name="Test" />');

        expect($html)->toHaveSelectorWithAttributeValue('textarea', 'name', 'Test');
    });

    it('autogenerates a name and id', function () {
        $html = $this->render('<x-ui::textarea />');

        expect($html)
            ->toHaveSelectorWithAttributeMatching('textarea', 'name', '/textarea_.{13}/')
            ->toHaveSelectorWithAttributeMatching('textarea', 'id', '/textarea_.{13}/');
    });

    it('adds id', function () {
        $html = $this->render('<x-ui::textarea id="textarea-1" />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('textarea', 'id', 'textarea-1');
    });

    it('autogenerates name from wire:model', function () {
        $html = $this->render('<x-ui::textarea wire:model="title" />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('textarea', 'name', 'title')
            ->toHaveSelectorWithAttributeValue('textarea', 'id', 'title');
    });
});

describe('label and placeholder', function () {
    it('renders a label', function () {
        $html = $this->render('<x-ui::textarea label="Test" />');

        expect($html)
            ->toHaveSelectorWithValue('label', 'Test')
            ->not->toHaveSelectorWithAttribute('div', 'dusk')
            ->not->toHaveSelectorWithAttribute('textarea', 'placeholder');
    });

    it('has a label that matches the input', function () {
        $html = $this->render('<x-ui::textarea name="tester" label="Test" />');

        expect($html)
            ->toHaveSelectorWithValue('label', 'Test')
            ->toHaveSelectorWithAttributeValue('label', 'for', 'tester');
    });

    it('renders a placeholder', function () {
        $html = $this->render('<x-ui::textarea placeholder="Test" />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('textarea', 'placeholder', 'Test')
            ->not->toHaveSelectorWithAttribute('div', 'dusk')
            ->not->toHaveSelector('label');
    });

    it('can have different label and placeholder', function () {
        $html = $this->render('<x-ui::textarea label="Last" placeholder="Test" />');

        expect($html)
            ->toHaveSelectorWithAttribute('textarea', 'placeholder')
            ->toHaveSelectorWithValue('label', 'Last')
            ->not->toHaveSelectorWithAttribute('div', 'dusk');
    });

    it('autogenerates a placeholder from label', function () {
        $html = $this->render('<x-ui::textarea label="Tester" placeholder />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('textarea', 'placeholder', 'Tester');
    });
});

describe('dusk', function () {
    it('adds dusk', function () {
        $html = $this->render('<x-ui::textarea dusk="Dusk" />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('div', 'dusk', 'Dusk');
    });

    it('autogenerates dusk from name', function () {
        $html = $this->render('<x-ui::textarea name="test" dusk />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('div', 'dusk', 'textarea-test');
    });

    it('autogenerates renders different dusk and name', function () {
        $html = $this->render('<x-ui::textarea name="test" dusk="another" />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('div', 'dusk', 'another');
    });
});

describe('merge', function () {
    it('alters rows', function () {
        $html = $this->render('<x-ui::textarea rows=5 />');

        expect($html)
            ->toHaveSelectorWithAttributeValue('textarea', 'rows', '5');
    });
});

describe('clearing', function () {
    it('removes the clearing margin', function () {
        $html = $this->render('<x-ui::textarea :add_clearing="false" />');

        expect($html)
            ->not->toHaveSelectorWithAttributeMatching('div', 'class', '/mb-3/');
    });

    it('adds clearing margin by default', function () {
        $html = $this->render('<x-ui::textarea />');

        expect($html)
            ->toHaveSelectorWithAttributeMatching('div', 'class', '/mb-3/');
    });
});

describe('errors', function () {
    it('renders errors', function () {
        $html = $this->render('<x-ui::textarea name="test" error="Required" />');

        expect($html)
            ->toHaveSelectorWithValue('#test-error', 'Required');
    });
});
