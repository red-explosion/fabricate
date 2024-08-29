<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Pipes;

use Closure;
use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Data\InstallData;
use Symfony\Component\Process\Process;

class InstallPulse
{
    public function __construct(
        protected readonly ReplaceInFileAction $replaceInFile,
    ) {
    }

    public function handle(InstallData $data, Closure $next)
    {
        $publishCommand = [
            'php',
            'artisan',
            'vendor:publish',
            '--provider="Laravel\Pulse\PulseServiceProvider"'
        ];

        (new Process($publishCommand, base_path()))->run();
        (new Process(['php', 'artisan', 'migrate']))->run();

        $this->replaceInFile->handle(
            <<<EOT
            use Illuminate\Support\Facades\Log;
            EOT,
            <<<EOT
            use Illuminate\Support\Facades\Gate;
            use Illuminate\Support\Facades\Log;
            EOT,
            app_path('Providers/AppServiceProvider.php'),
        );

        $this->replaceInFile->handle(
            <<<EOT
                    Relation::enforceMorphMap([
                        'user' => User::class,
                    ]);
            EOT,
            <<<EOT
                    Relation::enforceMorphMap([
                        'user' => User::class,
                    ]);

                    Gate::define('viewPulse', fn (User \$user) => \$user->is_admin);
            EOT,
            app_path('Providers/AppServiceProvider.php'),
        );

        return $next($data);
    }
}
