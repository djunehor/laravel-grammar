<?php

namespace Djunehor\Grammar\Facades;

use Illuminate\Support\Facades\Facade;

class GrammarFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-grammar';
    }
}
