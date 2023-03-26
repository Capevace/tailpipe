<?php

namespace Tailpipe\Facades;

use Illuminate\Support\Facades\Facade;
use Tailpipe\Tailpipe as TailpipeClass;

class Tailpipe extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'tailpipe';
    }
}
