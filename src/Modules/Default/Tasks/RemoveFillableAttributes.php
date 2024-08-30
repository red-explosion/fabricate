<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;

class RemoveFillableAttributes extends Task
{
    public function __construct(
        protected readonly ReplaceInFileAction $replaceInFile,
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Removing fillable attributes';
    }

    public function perform(InstallData $data): void
    {
        $this->replaceInFile->handle(
            <<<'EOT'

                /**
                 * The attributes that are mass assignable.
                 *
                 * @var array<int, string>
                 */
            EOT,
            '',
            app_path('Models/User.php'),
        );

        $contents = $this->filesystem->get(app_path('Models/User.php'));

        /** @var string $contents */
        $contents = preg_replace('/protected \$fillable\s*=\s*\[[^\]]*\];\s*/m', '', $contents);

        $this->filesystem->put(app_path('Models/User.php'), $contents);
    }
}
