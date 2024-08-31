<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Console;

use Illuminate\Console\Command;
use Laravel\Prompts\Progress;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Modules\Default\DefaultModule;
use RedExplosion\Fabricate\Task;

use function Laravel\Prompts\progress;
use function Laravel\Prompts\text;

class InstallCommand extends Command
{
    protected $signature = 'fabricate:install';

    protected $description = 'Install the Fabricate scaffolding';

    public function handle(): void
    {
        $name = text(
            label: 'Enter a name for your project',
            placeholder: 'Project Name',
            required: true,
        );

        $vendor = text(
            label: 'Enter a vendor name for your project',
            placeholder: 'Red Explosion',
            required: true,
        );

        $description = text(
            label: 'Enter a description for your project',
            placeholder: 'The source code for the Project Name website.',
        );

        $installData = new InstallData(
            name: $name,
            vendor: $vendor,
            description: $description,
        );

        $tasks = DefaultModule::tasks();

        progress(
            label: 'Installing Fabricate',
            steps: $tasks,
            callback: function ($taskClass, Progress $progress) use ($installData): void {
                /** @var Task $task */
                $task = app($taskClass);

                $progress
                    ->label($task->progressLabel())
                    ->render();

                $task->perform($installData);
            },
            hint: 'This may take a couple of minutes, please wait.'
        );

        $this->components->success('Fabricate has finished installing, it\'s time to build something awesome 🎉');
    }
}
