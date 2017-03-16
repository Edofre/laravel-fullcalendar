<?php

namespace Edofre\Fullcalendar\Test\Integration;

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
}