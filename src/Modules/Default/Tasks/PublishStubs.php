<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;

class PublishStubs extends Task
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Publishing stubs';
    }

    public function perform(InstallData $data): void
    {
        $this->filesystem->copyDirectory(
            __DIR__ . '/../../../../stubs/default/.github',
            base_path('.github'),
        );

        $this->filesystem->copyDirectory(
            __DIR__ . '/../../../../stubs/default/app/Notifications',
            app_path('Notifications'),
        );

        $this->filesystem->copyDirectory(
            __DIR__ . '/../../../../stubs/default/app/Support',
            app_path('Support'),
        );

        $this->filesystem->copyDirectory(
            __DIR__ . '/../../../../stubs/default/../../stubs',
            base_path('../../stubs'),
        );

        $this->filesystem->copyDirectory(
            __DIR__ . '/../../../../stubs/default/tests/Arch',
            base_path('tests/Arch'),
        );

        $this->filesystem->copy(
            __DIR__ . '/../../../../stubs/default/gitignore',
            base_path('.gitignore'),
        );

        $this->filesystem->copy(
            __DIR__ . '/../../../../stubs/default/phpstan.neon.dist',
            base_path('phpstan.neon.dist'),
        );

        $this->filesystem->copy(
            __DIR__ . '/../../../../stubs/default/README.md',
            base_path('README.md'),
        );

        $this->filesystem->copy(
            __DIR__ . '/../../../../stubs/default/rector.php',
            base_path('rector.php'),
        );
    }
}
