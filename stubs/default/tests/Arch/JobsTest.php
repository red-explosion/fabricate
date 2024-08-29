<?php

declare(strict_types=1);

arch('jobs')
    ->expect('App\Jobs')
    ->toHaveSuffix('Job')
    ->toHaveMethod('handle')
    ->toExtendNothing()
    ->toImplement('Illuminate\Contracts\Queue\ShouldQueue');
