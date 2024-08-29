<?php

declare(strict_types=1);

arch('notifications')
    ->expect('App\Notifications')
    ->toHaveConstructor()
    ->ignoring([
        'App\Notifications\ResetPassword',
        'App\Notifications\VerifyEmail',
    ])
    ->toExtend('Illuminate\Notifications\Notification');
