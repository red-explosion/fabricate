<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Console;

use Illuminate\Console\Command;
use RedExplosion\Fabricate\Data\InstallData;
use RedExplosion\Fabricate\Install;

class InstallCommand extends Command
{
    protected $signature = 'fabricate:install';

    protected $description = 'Install the Fabricate scaffolding';

    public function handle(Install $install): void
    {
         $install->process(new InstallData());
    }
}
