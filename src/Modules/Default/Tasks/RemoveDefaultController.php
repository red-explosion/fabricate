<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Task;

class RemoveDefaultController extends Task
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Removing default controller';
    }

    public function perform(): void
    {
        $this->filesystem->delete(base_path('app/Http/Controllers/Controller.php'));

        $this->filesystem->put(base_path('app/Http/Controllers/.gitkeep'), '');
    }
}
