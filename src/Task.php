<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate;

use RedExplosion\Fabricate\Data\InstallData;

abstract class Task
{
    abstract public function progressLabel(): string;

    abstract public function perform(InstallData $data): void;
}
