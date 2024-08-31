<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;
use Symfony\Component\Process\Process;

class InstallYarnDependencies extends Task
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Installing Yarn dependencies';
    }

    public function perform(InstallData $data): void
    {
        $this->filesystem->deleteDirectory(base_path('node_modules'));
        $this->filesystem->delete(base_path('package.lock'));

        (new Process(['yarn', 'install'], base_path()))->run();
    }
}
