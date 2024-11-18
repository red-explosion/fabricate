<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use RedExplosion\Fabricate\Actions\RemoveComposerPackagesAction;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;

class RemoveComposerDependencies extends Task
{
    public function __construct(
        protected readonly RemoveComposerPackagesAction $removeComposerPackages,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Removing Composer dependencies';
    }

    public function perform(InstallData $data): void
    {
        $this->removeComposerPackages->handle([
            'phpunit/phpunit',
        ], asDev: true);
    }
}
