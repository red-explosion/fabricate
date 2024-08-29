<?php

declare(strict_types=1);

arch('will not use debugging functions')
    ->expect(['dd', 'ddd', 'dump', 'die', 'var_dump', 'sleep', 'ray'])
    ->not->toBeUsed();

arch('env helper not to be used')
    ->expect('env')
    ->not->toBeUsed();

arch('strict types are used')
    ->expect('App')
    ->toUseStrictTypes();
