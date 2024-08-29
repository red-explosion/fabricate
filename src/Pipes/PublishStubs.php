<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Pipes;

use Closure;
use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Data\InstallData;

class PublishStubs
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function handle(InstallData $data, Closure $next)
    {
        $this->filesystem->copyDirectory(
            __DIR__ . '/../../stubs/default/.github',
            base_path('.github'),
        );

        $this->filesystem->copyDirectory(
            __DIR__ . '/../../stubs/default/app/Support',
            app_path('Support'),
        );

        $this->filesystem->copyDirectory(
            __DIR__ . '/../../stubs/default/stubs',
            base_path('stubs'),
        );

        $this->filesystem->copyDirectory(
            __DIR__ . '/../../stubs/default/tests/Arch',
            base_path('tests/Arch'),
        );

        $this->filesystem->copy(
            __DIR__ . '/../../stubs/default/gitignore',
            base_path('.gitignore'),
        );

        $this->filesystem->copy(
            __DIR__ . '/../../stubs/default/phpstan.neon.dist',
            base_path('phpunit.xml.dist'),
        );

        $this->filesystem->copy(
            __DIR__ . '/../../stubs/default/README.md',
            base_path('README.md'),
        );

        $this->filesystem->copy(
            __DIR__ . '/../../stubs/default/rector.php',
            base_path('rector.php'),
        );

        return $next($data);
    }
}
