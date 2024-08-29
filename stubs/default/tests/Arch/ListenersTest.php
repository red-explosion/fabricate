<?php

declare(strict_types=1);

arch('listeners')
    ->expect('App\Listeners')
    ->toHaveMethod('handle')
    ->not->toBeUsed();
