<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;
use Symfony\Component\Process\Process;

class UpdateComposerMeta extends Task
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Updating Composer meta';
    }

    public function perform(InstallData $data): void
    {
        $contents = $this->filesystem->json(base_path('composer.json'));

        unset($contents['keywords']);

        $contents['require']['php'] = '^8.3';

        $contents = [
            ...$contents,
            'name' => $data->name,
            'license' => 'proprietary',
        ];

        if ($data->description) {
            $contents['description'] = $data->description;
        }

        /** @var string $contents */
        $contents = json_encode($contents, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        $this->filesystem->put(base_path('composer.json'), $contents);

        (new Process(['composer', 'update', '--lock'], base_path()))->run();
    }
}
