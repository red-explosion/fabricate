<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;

class UseHasSqids extends Task
{
    public function __construct(
        protected readonly ReplaceInFileAction $replaceInFile,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Adding HasSqids to models';
    }

    public function perform(InstallData $data): void
    {
        $this->replaceInFile->handle(
            <<<EOT
            use Illuminate\Notifications\Notifiable;
            EOT,
            <<<EOT
            use Illuminate\Notifications\Notifiable;
            use RedExplosion\Sqids\Concerns\HasSqids;
            EOT,
            app_path('Models/User.php'),
        );

        $this->replaceInFile->handle(
            <<<'EOT'
            use Notifiable;
            EOT,
            <<<'EOT'
            use HasSqids;
            use Notifiable;
            EOT,
            app_path('Models/User.php'),
        );
    }
}
