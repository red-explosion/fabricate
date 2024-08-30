<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;

class ConfigureTestingDatabase extends Task
{
    public function __construct(
        protected readonly Filesystem $filesystem,
        protected readonly ReplaceInFileAction $replaceInFile,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Configuring testing database';
    }

    public function perform(InstallData $data): void
    {
        $this->filesystem->move(
            base_path('phpunit.xml'),
            base_path('phpunit.xml.dist'),
        );

        $this->replaceInFile->handle(
            <<<'EOT'
                    <!-- <env name="DB_CONNECTION" value="sqlite"/> -->
                    <!-- <env name="DB_DATABASE" value=":memory:"/> -->
            EOT,
            <<<'EOT'
                    <env name="DB_DATABASE" value="testing"/>
            EOT,
            base_path('phpunit.xml.dist'),
        );
    }
}
