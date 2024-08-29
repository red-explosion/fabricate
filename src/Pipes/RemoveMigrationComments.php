<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Pipes;

use Closure;
use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Data\InstallData;

class RemoveMigrationComments
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function handle(InstallData $data, Closure $next)
    {
        $migrations = $this->filesystem->files(database_path('migrations'));

        foreach ($migrations as $migration) {
            $contents = $this->filesystem->get($migration->getPathname());

            $contents = preg_replace('/\/\*\*[\s\S]*?\*\//', '', $contents);

            $this->filesystem->put($migration->getPathname(), $contents);
        }

        return $next($data);
    }
}
