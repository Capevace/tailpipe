<?php

namespace Tailpipe;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Capevace\Tailpipe\Skeleton\SkeletonClass
 */
class TailpipeFacade extends Facade
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
