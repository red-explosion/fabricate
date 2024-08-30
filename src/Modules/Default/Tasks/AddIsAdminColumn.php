<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Task;

class AddIsAdminColumn extends Task
{
    public function __construct(
        protected readonly ReplaceInFileAction $replaceInFile,
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Adding is_admin column';
    }

    public function perform(): void
    {
        $this->replaceInFile->handle(
            <<<'EOT'
                        $table->timestamps();
            EOT,
            <<<'EOT'
                        $table->boolean('is_admin')->default(false);
                        $table->timestamps();
            EOT,
            database_path('migrations/0001_01_01_000000_create_users_table.php'),
        );

        $this->replaceInFile->handle(
            <<<'EOT'
                        'password' => 'hashed',
            EOT,
            <<<'EOT'
                        'password' => 'hashed',
                        'is_admin' => 'boolean',
            EOT,
            app_path('Models/User.php'),
        );

        $this->replaceInFile->handle(
            <<<'EOT'
                        'remember_token' => Str::random(10),
            EOT,
            <<<'EOT'
                        'remember_token' => Str::random(10),
                        'is_admin' => false,
            EOT,
            database_path('factories/UserFactory.php'),
        );

        // add admin state
        $userFactoryContents = $this->filesystem->get(database_path('factories/UserFactory.php'));

        $adminState = <<<'EOT'

            public function admin(): static
            {
                return $this->state(fn (array $attributes): array => [
                    'is_admin' => true,
                ]);
            }
        }
        EOT;

        $this->filesystem->put(
            database_path('factories/UserFactory.php'),
            substr($userFactoryContents, 0, -2) . $adminState,
        );
    }
}
