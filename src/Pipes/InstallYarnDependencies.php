<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Pipes;

use Closure;
use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Data\InstallData;
use Symfony\Component\Process\Process;

class InstallYarnDependencies
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function handle(InstallData $data, Closure $next)
    {
        $this->filesystem->deleteDirectory(base_path('node_modules'));
        $this->filesystem->delete(base_path('package.lock'));

        // TODO: log that we are installing Yarn dependencies

        (new Process(['yarn', 'install'], base_path()))->run();

        return $next($data);
    }
}
