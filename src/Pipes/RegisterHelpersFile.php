<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Pipes;

use Closure;
use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Data\InstallData;
use Symfony\Component\Process\Process;

class RegisterHelpersFile
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function handle(InstallData $data, Closure $next)
    {
        $composer = $this->filesystem->json(base_path('composer.json'));

        $composer['autoload']['files'] = [
            'app/Support/helpers.php',
        ];

        $this->filesystem->put(base_path('composer.json'), json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        (new Process(['composer', 'dump-autoload'], base_path()))->run();

        return $next($data);
    }
}
