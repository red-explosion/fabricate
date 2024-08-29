<?php

declare(strict_types=1);

arch('providers')
    ->expect('App\Providers')
    ->toHaveSuffix('Provider')
    ->toExtend('Illuminate\Support\ServiceProvider')
    ->not->toBeUsed();
