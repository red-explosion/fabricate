<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Pipes;

use Closure;
use RedExplosion\Fabricate\Data\InstallData;
use Symfony\Component\Process\Process;

class RunRefactorScript
{
    public function handle(InstallData $data, Closure $next)
    {
        (new Process(['composer', 'refactor'], base_path()))->run();

        return $next($data);
    }
}
