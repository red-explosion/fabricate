<?php

declare(strict_types=1);

arch('rules')
    ->expect('App\Rules')
    ->toImplement('Illuminate\Contracts\Validation\ValidationRule')
    ->toHaveMethod('validate')
    ->toOnlyBeUsedIn('App\Http\Requests');
