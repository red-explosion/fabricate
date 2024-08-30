<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Contracts;

use RedExplosion\Fabricate\Task;

interface Module
{
    public static function name(): string;

    /**
     * @return array<int, class-string<Task>>
     */
    public static function tasks(): array;
}
