<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Task;

class FixLarastanErrors extends Task
{
    public function __construct(
        protected readonly ReplaceInFileAction $replaceInFile,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Fixing Larastan errors';
    }

    public function perform(): void
    {
        $this->replaceInFile->handle(
            'use Illuminate\Database\Eloquent\Factories\HasFactory;',
            <<<EOT
            use Database\Factories\UserFactory;
            use Illuminate\Database\Eloquent\Factories\HasFactory;
            EOT,
            app_path('Models/User.php'),
        );

        $this->replaceInFile->handle(
            'use HasFactory;',
            <<<'EOT'
                /** @use HasFactory<UserFactory> */
                use HasFactory;
            EOT,
            app_path('Models/User.php'),
        );

        $this->replaceInFile->handle(
            <<<EOT
            use Illuminate\Foundation\Inspiring;
            use Illuminate\Support\Facades\Artisan;

            Artisan::command('inspire', function (): void {
                \$this->comment(Inspiring::quote());
            })->purpose('Display an inspiring quote')->hourly();
            EOT,
            '',
            base_path('routes/console.php'),
        );
    }
}
