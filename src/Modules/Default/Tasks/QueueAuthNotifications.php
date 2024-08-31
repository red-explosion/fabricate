<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use Illuminate\Filesystem\Filesystem;
use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;

class QueueAuthNotifications extends Task
{
    public function __construct(
        protected readonly ReplaceInFileAction $replaceInFile,
        protected readonly Filesystem $filesystem,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Queueing auth notifications';
    }

    public function perform(InstallData $data): void
    {
        $this->replaceInFile->handle(
            <<<EOT
            use Database\Factories\UserFactory;
            EOT,
            <<<EOT
            use App\Notifications\ResetPassword;
            use App\Notifications\VerifyEmail;
            use Database\Factories\UserFactory;
            EOT,
            app_path('Models/User.php'),
        );

        $userModelContents = $this->filesystem->get(app_path('Models/User.php'));

        $methods = <<<'EOT'

            public function sendEmailVerificationNotification(): void
            {
                $this->notify(new VerifyEmail());
            }

            /**
             * @param  string  $token
             */
            public function sendPasswordResetNotification($token): void
            {
                $this->notify(new ResetPassword($token));
            }
        }
        EOT;

        $this->filesystem->put(
            app_path('Models/User.php'),
            substr($userModelContents, 0, -2) . $methods,
        );
    }
}
