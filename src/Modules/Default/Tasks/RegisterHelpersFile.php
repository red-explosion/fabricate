<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;
use Symfony\Component\Process\Process;

class RegisterHelpersFile extends Task
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Registering helper files';
    }

    public function perform(InstallData $data): void
    {
        $composer = $this->filesystem->json(base_path('composer.json'));

        $composer['autoload']['files'] = [
            'app/Support/helpers.php',
        ];

        /** @var string $contents */
        $contents = json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        $this->filesystem->put(base_path('composer.json'), $contents);

        (new Process(['composer', 'dump-autoload'], base_path()))->run();
    }
}
