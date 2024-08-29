<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Pipes;

use Closure;
use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Data\InstallData;

class RegisterComposerScripts
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function handle(InstallData $data, Closure $next)
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

        $this->filesystem->put(base_path('composer.json'), json_encode($contents, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        return $next($data);
    }
}
