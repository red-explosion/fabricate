<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;
use Symfony\Component\Process\Process;

class RunRefactorScript extends Task
{
    public function progressLabel(): string
    {
        return 'Running refactor script';
    }

    public function perform(InstallData $data): void
    {
        (new Process(['composer', 'refactor'], base_path()))->run();
    }
}
