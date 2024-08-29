<?php

declare(strict_types=1);

arch('view models')
    ->expect('App\ViewModels')
    ->toHaveSuffix('ViewModel')
    ->toExtend('Spatie\LaravelData\Data')
    ->toHaveConstructor();
