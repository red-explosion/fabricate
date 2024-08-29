<?php

declare(strict_types=1);

arch('controllers')
    ->expect('App\Http\Controllers')
    ->toHaveSuffix('Controller')
    ->toExtendNothing();

arch('integration connectors')
    ->expect([])
    ->toExtend('Saloon\Http\Connector')
    ->toOnlyBeUsedIn('App\Services');

arch('integration requests')
    ->expect([])
    ->toHaveSuffix('Request')
    ->toExtend('Saloon\Http\Request')
    ->toOnlyBeUsedIn('App\Services');

arch('middleware')
    ->expect('App\Http\Middleware')
    ->toHaveMethod('handle');

arch('requests')
    ->expect('App\Http\Requests')
    ->toHaveSuffix('Request')
    ->toExtend('Illuminate\Foundation\Http\FormRequest')
    ->toHaveMethod('rules')
    ->toOnlyBeUsedIn('App\Http\Controllers');
