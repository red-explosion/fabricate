<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;

class ImplementMustVerifyEmail extends Task
{
    public function __construct(
        protected readonly ReplaceInFileAction $replaceInFile,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Implementing MustVerifyEmail';
    }

    public function perform(InstallData $data): void
    {
        $this->replaceInFile->handle(
            '// use Illuminate\Contracts\Auth\MustVerifyEmail;',
            'use Illuminate\Contracts\Auth\MustVerifyEmail;',
            app_path('Models/User.php'),
        );

        $this->replaceInFile->handle(
            'extends Authenticatable',
            'extends Authenticatable implements MustVerifyEmail',
            app_path('Models/User.php'),
        );
    }
}
