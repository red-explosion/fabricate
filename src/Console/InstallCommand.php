<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Console;

use Illuminate\Console\Command;
use Laravel\Prompts\Progress;
use RedExplosion\Fabricate\Modules\Default\DefaultModule;
use RedExplosion\Fabricate\Task;

use function Laravel\Prompts\progress;

class InstallCommand extends Command
{
    protected $signature = 'fabricate:install';

    protected $description = 'Install the Fabricate scaffolding';

    public function handle(): void
    {
        $tasks = DefaultModule::tasks();

        progress(
            label: 'Installing Fabricate',
            steps: $tasks,
            callback: function ($taskClass, Progress $progress): void {
                /** @var Task $task */
                $task = app($taskClass);

                $progress
                    ->label($task->progressLabel())
                    ->hint($task->progressHint())
                    ->render();

                $task->perform();
            },
        );
    }
}
