<?php

declare(strict_types=1);

arch('observers')
    ->expect('App\Observers')
    ->toHaveSuffix('Observer');
