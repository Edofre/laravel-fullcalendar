<?php

namespace Edofre\Fullcalendar\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Fullcalendar
 * @package Edofre\Fullcalendar\Facades
 */
class Fullcalendar extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-fullcalendar';
    }
}