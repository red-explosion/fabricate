<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default\Tasks;

use RedExplosion\Fabricate\Actions\ReplaceInFileAction;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Task;

class ConfigureAppServiceProvider extends Task
{
    public function __construct(
        protected readonly ReplaceInFileAction $replaceInFile,
    ) {
    }

    public function progressLabel(): string
    {
        return 'Configuring Eloquent models';
    }

    public function perform(InstallData $data): void
    {
        $this->replaceInFile->handle(
            <<<EOT
            use Illuminate\Support\ServiceProvider;
            EOT,
            <<<EOT
            use App\Models\User;
            use Illuminate\Database\Eloquent\Model;
            use Illuminate\Database\Eloquent\Relations\Relation;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Log;
            use Illuminate\Support\ServiceProvider;
            use Illuminate\Validation\Rules\Password;
            EOT,
            base_path('app/Providers/AppServiceProvider.php'),
        );

        $this->replaceInFile->handle(
            <<<'EOT'
                public function boot(): void
                {

                }
            EOT,
            <<<'EOT'
                public function boot(): void
                {
                    $this->configureCommands();
                    $this->configureModels();
                    $this->configureRelations();
                    $this->configurePasswordDefaults();
                }

                protected function configureCommands(): void
                {
                    DB::prohibitDestructiveCommands(
                        $this->app->isProduction(),
                    );
                }

                protected function configureModels(): void
                {
                    Model::unguard();

                    Model::preventLazyLoading(! $this->app->isProduction());
                    Model::preventSilentlyDiscardingAttributes();
                    Model::preventAccessingMissingAttributes();

                    if ($this->app->isProduction()) {
                        Model::handleLazyLoadingViolationUsing(function (Model $model, string $relation): void {
                            $class = $model::class;

                            Log::warning("Attempted to lazy load [{$relation}] on model [{$class}].");
                        });
                    }
                }

                protected function configureRelations(): void
                {
                    Relation::enforceMorphMap([
                        'user' => User::class,
                    ]);
                }

                protected function configurePasswordDefaults(): void
                {
                    Password::defaults(
                        Password::min(8)
                            ->letters()
                            ->numbers()
                            ->symbols(),
                    );
                }
            EOT,
            base_path('app/Providers/AppServiceProvider.php'),
        );
    }
}
