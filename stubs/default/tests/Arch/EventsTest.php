<?php

declare(strict_types=1);

arch('events')
    ->expect('App\Events')
    ->toExtendNothing()
    ->toHaveConstructor();
