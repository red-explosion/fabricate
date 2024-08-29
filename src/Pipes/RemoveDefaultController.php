<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Pipes;

use Closure;
use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Data\InstallData;

class RemoveDefaultController
{
    public function __construct(
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function handle(InstallData $data, Closure $next)
    {
        $this->filesystem->delete(base_path('app/Http/Controllers/Controller.php'));

        $this->filesystem->put(base_path('app/Http/Controllers/.gitkeep'), '');

        return $next($data);
    }
}
