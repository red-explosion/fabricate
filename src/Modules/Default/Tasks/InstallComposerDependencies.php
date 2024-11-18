<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use RedExplosion\Fabricate\Actions\RequireComposerPackagesAction;
use RedExplosion\Fabricate\Data\InstallData;
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

    public function perform(InstallData $data): void
    {
        $this->requireComposerPackages->handle([
            'laravel/horizon',
            'laravel/pulse',
            // 'league/flysystem-aws-s3-v3:^3.0',
            'red-explosion/laravel-sqids',
            'spatie/laravel-data',
        ]);

        $this->requireComposerPackages->handle([
            'larastan/larastan',
            'pestphp/pest',
            'pestphp/pest-plugin-laravel',
            'rector/rector',
            'red-explosion/pint-config',
        ], asDev: true);
    }
}
