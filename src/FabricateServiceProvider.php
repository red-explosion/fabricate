<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate;

use Illuminate\Support\ServiceProvider;

class FabricateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            path: __DIR__ . '/../config/fabricate.php',
            key: 'fabricate',
        );
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                paths: [
                    __DIR__ . '/../config/fabricate.php' => config_path('fabricate.php'),
                ],
                groups: 'fabricate-config',
            );
        }
    }
}
