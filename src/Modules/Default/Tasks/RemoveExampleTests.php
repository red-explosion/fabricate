<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;

class RemoveExampleTests extends Task
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Removing example tests';
    }

    public function perform(InstallData $data): void
    {
        $this->removeExampleFeatureTest();
        $this->removeExampleUnitTest();
    }

    protected function removeExampleFeatureTest(): void
    {
        if (! $this->filesystem->exists($path = base_path('tests/Feature/ExampleTest.php'))) {
            return;
        }

        $this->filesystem->delete($path);

        $this->filesystem->put(base_path('tests/Feature/.gitkeep'), '');
    }

    protected function removeExampleUnitTest(): void
    {
        if (! $this->filesystem->exists($path = base_path('tests/Unit/ExampleTest.php'))) {
            return;
        }

        $this->filesystem->delete($path);

        $this->filesystem->put(base_path('tests/Unit/.gitkeep'), '');
    }
}
