<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Task;

class RemoveDownMigrations extends Task
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Removing down migrations';
    }

    public function perform(): void
    {
        $migrations = $this->filesystem->files(database_path('migrations'));

        foreach ($migrations as $migration) {
            $contents = $this->filesystem->get($migration->getPathname());

            /** @var string $contents */
            $contents = preg_replace('/public function down\(\): void\s*\{[^}]*\}/s', '', $contents);

            $this->filesystem->put($migration->getPathname(), $contents);
        }
    }
}
