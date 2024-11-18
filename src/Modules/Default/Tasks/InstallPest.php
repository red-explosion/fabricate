<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;
use Symfony\Component\Process\Process;

class InstallPest extends Task
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Installing Pest';
    }

    public function perform(InstallData $data): void
    {
        if ($this->filesystem->exists('tests/Pest.php')) {
            return;
        }

        (new Process(['./vendor/bin/pest', '--init']))->run();
    }
}
