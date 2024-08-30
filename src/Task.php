<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate;

abstract class Task
{
    abstract public function progressLabel(): string;

    public function progressHint(): string
    {
        return '';
    }

    abstract public function perform(): void;
}
