<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Pipes;

use Closure;
use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Data\InstallData;
use Symfony\Component\Process\Process;

class InstallHorizon
{
    public function __construct(
        protected readonly ReplaceInFileAction $replaceInFile,
    ) {
    }

    public function handle(InstallData $data, Closure $next)
    {
        (new Process(['php', 'artisan', 'horizon:install'], base_path()))->run();

        $this->replaceInFile->handle(
            'supervisor-1',
            'default-supervisor',
            config_path('horizon.php'),
        );

        $this->replaceInFile->handle(
            <<<EOT
                    'local' => [
                        'default-supervisor' => [
                            'maxProcesses' => 3,
                        ],
                    ],
            EOT,
            <<<EOT
                    'staging' => [
                        'default-supervisor' => [
                            'maxProcesses' => 10,
                            'balanceMaxShift' => 1,
                            'balanceCooldown' => 3,
                        ],
                    ],

                    'local' => [
                        'default-supervisor' => [
                            'maxProcesses' => 3,
                        ],
                    ],
            EOT,
            config_path('horizon.php'),
        );

        $this->replaceInFile->handle(
            <<<EOT
                    Gate::define('viewHorizon', function (\$user) {
                        return in_array(\$user->email, [
                            //
                        ]);
                    });
            EOT,
            <<<EOT
                    Gate::define('viewHorizon', fn (User \$user) => \$user->is_admin);
            EOT,
            app_path('Providers/HorizonServiceProvider.php'),
        );

        // register snapshot command
        $this->replaceInFile->handle(
            <<<EOT
            declare(strict_types=1);
            EOT,
            <<<EOT
            declare(strict_types=1);

            use Illuminate\Support\Facades\Schedule;

            Schedule::command('horizon:snapshot')->everyFiveMinutes();
            EOT,
            base_path('routes/console.php'),
        );

        return $next($data);
    }
}
