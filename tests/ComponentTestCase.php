<?php

namespace Tests;

use Gajus\Dindent\Exception\RuntimeException;
use Gajus\Dindent\Indenter;
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
        $html = $this->blade($blade)->__toString();

        $filters = [
            '/<!--([^\[|(<!)].*)/' => '', // Remove HTML Comments (breaks with HTML5 Boilerplate)
            '/(?<!\S)\/\/\s*[^\r\n]*/' => '', // Remove comments in the form /* */
            '/\s{2,}/' => ' ', // Shorten multiple white spaces
            '/\s>/' => '>', // Remove white spaces before a closing >
            '/(\r?\n)/' => '', // Collapse new lines
            '/(\>)\s*(\<)/m' => '$1$2', // Trim Final Whitespace from between html tags
        ];

        $html = preg_replace(array_keys($filters), array_values($filters), $html);

        $indenter = new Indenter();

        return $indenter->indent($html);
    }
}
