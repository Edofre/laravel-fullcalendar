<?php

namespace Edofre\Fullcalendar\Test\Integration;

use Orchestra\Testbench\TestCase as Orchestra;

/**
 * Class TestCase
 * @package Edofre\Fullcalendar\Test\Integration
 */
abstract class TestCase extends Orchestra
{
    /**
     * Do any setup
     */
    public function setUp()
    {
        parent::setUp();
    }
}
