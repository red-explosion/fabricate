<?php

declare(strict_types=1);

namespace RedExplosion\Fabricate\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use RedExplosion\Fabricate\FabricateServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            FabricateServiceProvider::class,
        ];
    }
}
