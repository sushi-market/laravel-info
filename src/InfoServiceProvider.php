<?php

namespace DF\LaravelInfo;

use DF\LaravelInfo\Sections\CacheSection;
use DF\LaravelInfo\Sections\ConfigSection;
use DF\LaravelInfo\Sections\EnvironmentSection;
use DF\LaravelInfo\Sections\RuntimeSection;
use DF\LaravelInfo\Sections\ServicesSection;
use DF\LaravelInfo\Sections\StackSection;
use Illuminate\Support\ServiceProvider;

class InfoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LaravelInfo::class, fn() => new LaravelInfo()
            ->addSection(new StackSection())
            ->addSection(new EnvironmentSection())
            ->addSection(new ConfigSection())
            ->addSection(new RuntimeSection())
            ->addSection(new CacheSection())
            ->addSection(new ServicesSection()),
        );
    }

    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-info.php', 'laravel-info');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-info');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}
