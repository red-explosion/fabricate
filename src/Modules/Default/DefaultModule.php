<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Modules\Default;

use RedExplosion\Fabricate\Contracts\Module;

class DefaultModule implements Module
{
    public static function name(): string
    {
        return 'Default';
    }

    public static function tasks(): array
    {
        return [
            Tasks\UpdateComposerMeta::class,
            Tasks\RemoveComposerDependencies::class,
            Tasks\InstallComposerDependencies::class,
            Tasks\InstallPest::class,
            Tasks\InstallYarnDependencies::class,
            Tasks\PublishStubs::class,
            Tasks\RegisterComposerScripts::class,
            Tasks\RunRefactorScript::class,
            Tasks\RunLintScript::class,
            Tasks\RegisterHelpersFile::class,
            Tasks\FixLarastanErrors::class,
            Tasks\ConfigureTestingDatabase::class,
            Tasks\RemoveDefaultController::class,
            Tasks\RemoveMigrationComments::class,
            Tasks\RemoveDownMigrations::class,
            Tasks\ConfigureAppServiceProvider::class,
            Tasks\RemoveFillableAttributes::class,
            Tasks\AddIsAdminColumn::class,
            Tasks\ImplementMustVerifyEmail::class,
            Tasks\QueueAuthNotifications::class,
            Tasks\InstallHorizon::class,
            Tasks\InstallPulse::class,
            Tasks\UseHasSqids::class,
            Tasks\ReplaceReadmePlaceholders::class,
            Tasks\RunRefactorScript::class,
            Tasks\RunLintScript::class,
        ];
    }
}
