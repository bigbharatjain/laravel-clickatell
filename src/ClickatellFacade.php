<?php

namespace Clickatell;

/**
 * This file is part of Clickatell,
 * a sms sending package using clickatell for Laravel.
 *
 * @license MIT
 * @package Clickatell
 */

use Illuminate\Support\Facades\Facade;

class ClickatellFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'clickatell';
    }
}
