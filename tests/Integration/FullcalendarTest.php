<?php

namespace Edofre\Fullcalendar\Test\Integration;

/**
 * Class FullcalendarTest
 * @package Edofre\Fullcalendar\Test\Integration
 */
class FullcalendarTest extends TestCase
{

    /** @test */
    public function generate_event_with_id()
    {
        // Generate a new fullcalendar instance
        $calendar = new \Edofre\Fullcalendar\Fullcalendar();

        // Set options
        $calendar->setOptions([
            'locale'      => 'nl',
            'weekNumbers' => true,
            'selectable'  => true,
            'defaultView' => 'agendaWeek',
        ]);

        // This looks terrible, I'm sorry...
        $this->assertEquals("<div id='fullcalendar'></div><!-- fullcalendar css -->
<link href=\"/css/fullcalendar.print.css\" rel=\"stylesheet\" media=\"print\">
<link href=\"/css/fullcalendar.css\" rel=\"stylesheet\">
<!-- moment js -->
<script src=\"/js/moment.js\"></script>
<!-- fullcalendar js -->
<script src=\"/js/fullcalendar.js\"></script>
<script src=\"/js/locale-all.js\"></script>


<script type=\"text/javascript\">
    jQuery(document).ready(function () {
        jQuery('#fullcalendar').fullCalendar({\"header\":{\"left\":\"prev,next today\",\"center\":\"title\",\"right\":\"month,agendaWeek,agendaDay\"},\"firstDay\":1,\"locale\":\"nl\",\"weekNumbers\":true,\"selectable\":true,\"defaultView\":\"agendaWeek\",\"events\":[]});
    });
</script>
", $calendar->generate());
    }
}