<?php

declare(strict_types=1);

arch('commands')
    ->expect('App\Console\Commands')
    ->toHaveSuffix('Command')
    ->toExtend('Illuminate\Console\Command')
    ->toHaveMethod('handle');
