<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Pipes;

use Closure;
use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Data\InstallData;

class RemoveDownMigrations
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

            $contents = preg_replace('/public function down\(\): void\s*\{[^}]*\}/s', '', $contents);

            $this->filesystem->put($migration->getPathname(), $contents);
        }

        return $next($data);
    }
}
