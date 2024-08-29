<?php

declare(strict_types=1);

arch('data objects')
    ->expect('App\Data')
    ->toHaveSuffix('Data')
    ->ignoring('App\Data\Casts')
    ->toExtend('Spatie\LaravelData\Data')
    ->ignoring('App\Data\Casts')
    ->toHaveConstructor()
    ->ignoring('App\Data\Casts');

arch('data casts')
    ->expect('App\Data\Casts')
    ->toImplement('Spatie\LaravelData\Casts\Cast');
