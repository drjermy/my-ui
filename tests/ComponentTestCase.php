<?php

namespace Tests;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use MyUi\MyUiServiceProvider;
use Orchestra\Testbench\TestCase;

abstract class ComponentTestCase extends TestCase
{
    use InteractsWithViews;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('view:clear');
    }

    protected function getPackageProviders($app): array
    {
        return [MyUiServiceProvider::class];
    }

    public function render($blade): string
    {
        return $this->blade($blade)->__toString();
    }
}
