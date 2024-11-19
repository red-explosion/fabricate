<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;

class RegisterArchTest extends Task
{
    public function __construct(
        protected readonly ReplaceInFileAction $replaceInFile,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Registering Arch test';
    }

    public function perform(InstallData $data): void
    {
        $this->replaceInFile->handle(
            <<<'EOT'
                </testsuites>
            EOT,
            <<<'EOT'
                    <testsuite name="Arch">
                        <file>tests/ArchTest.php</file>
                    </testsuite>
                </testsuites>
            EOT,
            base_path('phpunit.xml.dist'),
        );
    }
}
