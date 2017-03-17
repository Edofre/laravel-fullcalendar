<?php

namespace Edofre\Fullcalendar\Test\Integration;

use Carbon\Carbon;

/**
 * Class EventTest
 * @package Edofre\Fullcalendar\Test\Integration
 */
class EventTest extends \Orchestra\Testbench\TestCase
{
    /** @test */
    public function generate_event_with_id()
    {
        $model = new \Edofre\Fullcalendar\Event(
            [
                'id' => 1,
            ]
        );

        $this->assertEquals('1', $model->id);
        $this->assertNotEquals('2', $model->id);
    }

    /** @test */
    public function generate_event_with_start_end_dates()
    {
        $model = new \Edofre\Fullcalendar\Event(
            [
                'start' => Carbon::create(2016, 11, 16, 10),
                'end'   => Carbon::create(2016, 11, 16, 13),
            ]
        );

        $this->assertEquals("2016-11-16T10:00:00+00:00", $model->start);
        $this->assertNotEquals("2016-11-16T10:00:00+00:00", $model->end);
    }
}