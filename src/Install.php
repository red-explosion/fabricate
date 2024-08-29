<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate;

use Illuminate\Pipeline\Pipeline;
use RedExplosion\Fabricate\Data\InstallData;

class Install extends Pipeline
{
    public function process(InstallData $data): InstallData
    {
        return $this->send($data)
            ->through([
                // todo: composer meta
                Pipes\InstallComposerDependencies::class,
                Pipes\InstallYarnDependencies::class,
                Pipes\PublishStubs::class,
                Pipes\RegisterComposerScripts::class,
                Pipes\RunRefactorScript::class,
                Pipes\RunLintScript::class,
                Pipes\RegisterHelpersFile::class,
                Pipes\FixLarastanErrors::class,
                Pipes\ConfigureTestingDatabase::class,
                Pipes\RemoveDefaultController::class,
                Pipes\RemoveMigrationComments::class,
                Pipes\RemoveDownMigrations::class,
                Pipes\ConfigureEloquentModels::class,
                Pipes\RemoveFillableAttributes::class,
                Pipes\AddIsAdminColumn::class,
                Pipes\InstallHorizon::class,
                Pipes\InstallPulse::class,
                Pipes\UseHasSqids::class,
                Pipes\RunRefactorScript::class,
                Pipes\RunLintScript::class,
            ])
            ->thenReturn();
    }
}
