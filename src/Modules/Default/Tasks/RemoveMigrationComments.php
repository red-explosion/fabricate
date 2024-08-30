<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Task;

class RemoveMigrationComments extends Task
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Removing migration comments';
    }

    public function perform(): void
    {
        $migrations = $this->filesystem->files(database_path('migrations'));

        foreach ($migrations as $migration) {
            $contents = $this->filesystem->get($migration->getPathname());

            /** @var string $contents */
            $contents = preg_replace('/\/\*\*[\s\S]*?\*\//', '', $contents);

            $this->filesystem->put($migration->getPathname(), $contents);
        }
    }
}
