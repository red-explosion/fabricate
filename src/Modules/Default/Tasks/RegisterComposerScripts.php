<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;

class RegisterComposerScripts extends Task
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Registering Composer scripts';
    }

    public function perform(InstallData $data): void
    {
        $contents = $this->filesystem->json(base_path('composer.json'));

        $contents['scripts'] = array_merge($contents['scripts'], [
            'lint' => 'pint --config vendor/red-explosion/pint-config/pint.json',
            'refactor' => 'rector',
            'test:lint' => 'pint --config vendor/red-explosion/pint-config/pint.json --test',
            'test:refactor' => 'rector --dry-run',
            'test:types' => 'phpstan analyse',
            'test:arch' => 'pest --filter=arch',
            'test:unit' => 'pest --parallel',
            'test' => [
                '@test:lint',
                '@test:refactor',
                '@test:types',
                '@test:unit',
            ],
        ]);

        /** @var string $contents */
        $contents = json_encode($contents, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        $this->filesystem->put(base_path('composer.json'), $contents);
    }
}
