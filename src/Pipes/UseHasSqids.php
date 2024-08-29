<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Pipes;

use Closure;
use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Data\InstallData;

class UseHasSqids
{
    public function __construct(
        protected readonly ReplaceInFileAction $replaceInFile,
    ) {
    }

    public function handle(InstallData $data, Closure $next)
    {
        $this->replaceInFile->handle(
            <<<EOT
            use Illuminate\Notifications\Notifiable;
            EOT,
            <<<EOT
            use Illuminate\Notifications\Notifiable;
            use RedExplosion\Sqids\Concerns\HasSqids;
            EOT,
            app_path('Models/User.php'),
        );

        $this->replaceInFile->handle(
            <<<EOT
            use Notifiable;
            EOT,
            <<<EOT
            use HasSqids;
            use Notifiable;
            EOT,
            app_path('Models/User.php'),
        );

        return $next($data);
    }
}
