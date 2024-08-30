<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use RedExplosion\Fabricate\Task;
use Symfony\Component\Process\Process;

class RunLintScript extends Task
{
    public function progressLabel(): string
    {
        return 'Running lint script';
    }

    public function perform(): void
    {
        (new Process(['composer', 'lint'], base_path()))->run();
    }
}
