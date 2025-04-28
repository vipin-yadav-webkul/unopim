<?php

namespace Webkul\FixtureFactory\Providers;

use Illuminate\Support\ServiceProvider;
use Webkul\FixtureFactory\Console\GenerateFixture;
use Webkul\FixtureFactory\Services\CategoryFixtureFactory as CategoryFixtureFactoryService;
use Webkul\FixtureFactory\Services\ProductFixtureFactory as ProductFixtureFactoryService;

class FixtureFactoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('product-fixture-factory', function ($app) {
            return new ProductFixtureFactoryService;
        });

        $this->app->singleton('category-fixture-factory', function ($app) {
            return new CategoryFixtureFactoryService;
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateFixture::class,
            ]);
        }
    }
}
