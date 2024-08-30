<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use RedExplosion\Fabricate\Actions\RequireComposerPackagesAction;
use RedExplosion\Fabricate\Task;

class InstallComposerDependencies extends Task
{
    public function __construct(
        protected readonly RequireComposerPackagesAction $requireComposerPackages,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Installing Composer dependencies';
    }

    public function progressHint(): string
    {
        return 'This may take some time, please wait.';
    }

    public function perform(): void
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
    }
}
