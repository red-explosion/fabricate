<?php

declare(strict_types=1);

use App\Support\Type;

if (! function_exists('type')) {
    /**
     * @template TVariable
     *
     * @param  TVariable  $variable
     * @return Type<TVariable>
     */
    function type(mixed $variable): Type
    {
        return new Type($variable);
    }
}
