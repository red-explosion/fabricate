<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;

class RemoveDefaultController extends Task
{
    public function __construct(
        protected readonly Filesystem $filesystem,
        protected readonly ReplaceInFileAction $replaceInFile,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Removing default controller';
    }

    public function perform(InstallData $data): void
    {
        $controllers = $this->filesystem->allFiles(app_path('Http/Controllers'));

        foreach ($controllers as $controller) {
            $this->replaceInFile->handle(
                'use App\Http\Controllers\Controller;',
                '',
                $controller->getPathname(),
            );

            $this->replaceInFile->handle(
                ' extends Controller',
                '',
                $controller->getPathname(),
            );
        }

        $this->filesystem->delete(base_path('app/Http/Controllers/Controller.php'));

        $this->filesystem->put(base_path('app/Http/Controllers/.gitkeep'), '');
    }
}
