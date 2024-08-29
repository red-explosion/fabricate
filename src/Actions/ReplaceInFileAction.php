<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Actions;

use Illuminate\Filesystem\Filesystem;

class ReplaceInFileAction
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function handle(string $search, string $replace, string $path): void
    {
        $contents = str_replace($search, $replace, $this->filesystem->get($path));

        $this->filesystem->put($path, $contents);
    }
}
