<?php

namespace MyUi;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MyUiServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::anonymousComponentNamespace('ui', 'ui');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ui');
    }
}
