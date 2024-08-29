<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FabricateServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\InstallCommand::class,
        ]);
    }

    /**
     * @return array<int, class-string>
     */
    public function provides(): array
    {
        return [
            Console\InstallCommand::class,
        ];
    }
}
