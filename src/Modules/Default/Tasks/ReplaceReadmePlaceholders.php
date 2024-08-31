<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;

class ReplaceReadmePlaceholders extends Task
{
    public function __construct(
        protected readonly ReplaceInFileAction $replaceInFile,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Replacing README placeholders';
    }

    public function perform(InstallData $data): void
    {
        $this->replaceInFile->handle(
            'project_name',
            $data->name,
            base_path('README.md'),
        );

        $this->replaceInFile->handle(
            'vendor_name',
            $data->vendor,
            base_path('README.md'),
        );
    }
}
