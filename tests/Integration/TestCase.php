<?php

namespace Edofre\Fullcalendar\Test\Integration;

/**
 * Class EventTest
 * @package Edofre\Fullcalendar\Test\Integration
 */
abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Do any setup
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Edofre\Fullcalendar\FullcalendarServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Fullcalendar' => \Edofre\Fullcalendar\Facades\Fullcalendar::class,
        ];
    }
}