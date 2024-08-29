<?php

declare(strict_types=1);

arch('exceptions')
    ->expect('App\Exceptions')
    ->toExtend('Throwable');
