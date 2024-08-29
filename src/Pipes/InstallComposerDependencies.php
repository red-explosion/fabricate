<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Pipes;

use Closure;
use RedExplosion\Fabricate\Actions\RequireComposerPackagesAction;
use RedExplosion\Fabricate\Data\InstallData;

class InstallComposerDependencies
{
    public function __construct(
        protected readonly RequireComposerPackagesAction $requireComposerPackages,
    ) {
    }

    public function handle(InstallData $data, Closure $next)
    {
        $this->requireComposerPackages->handle([
            // 'filament/filament',
            'laravel/horizon',
            'laravel/pulse',
            'red-explosion/laravel-sqids',
            'spatie/laravel-data',
        ]);

        $this->requireComposerPackages->handle([
            'larastan/larastan',
            'rector/rector',
            'red-explosion/pint-config',
        ], asDev: true);

        return $next($data);
    }
}
