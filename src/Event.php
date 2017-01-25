<?php

namespace Edofre\Fullcalendar;

/**
 * Class Event
 * @package Edofre\Fullcalendar
 */
class Event
{
    /** Rendering options */
    const RENDERING_BACKGROUND = 'background';
    const RENDERING_INVERSE_BACKGROUND = 'inverse-background';

    /** @var  string Uniquely identifies the given event. Different instances of repeating events should all have the same id. */
    public $id;
    /** @var  string The text on an event's element */
    public $title;
    /** @var  boolean Whether an event occurs at a specific time-of-day. This property affects whether an event's time is shown. Also, in the agenda views, determines if it is displayed in the "all-day" section. */
    public $allDay = false;
    /** @var  string The date/time an event begins. A Moment-ish input, like an ISO8601 string. Throughout the API this will become a real Moment object. */
    public $start;
    /** @var  string The exclusive date/time an event ends. A Moment-ish input, like an ISO8601 string. Throughout the API this will become a real Moment object. */
    public $end;
    /** @var  string A URL that will be visited when this event is clicked by the user. For more information on controlling this behavior, see the eventClick callback. */
    public $url;
    /** @var  string|array A CSS class ( or array of classes) that will be attached to this event's element. */
    public $className;
    /** @var  boolean Is the Event editable? Both start and duration. */
    public $editable = false;
    /** @var  boolean Is the event start editable? */
    public $startEditable = false;
    /** @var  boolean Is the event duration editable? */
    public $durationEditable = false;
    /** @var  string Allows alternate rendering of the event, like background events. Can be empty, "background", or "inverse-background" */
    public $rendering;
    /** @var  boolean  Overrides the master eventOverlap option for this single event. If false, prevents this event from being dragged/resized over other events. Also prevents other events from being dragged/resized over this event. */
    public $overlap = true;
    /** @var  string an event ID, "businessHours", object. Optional. Overrides the master eventConstraint option for this single event. */
    public $constraint;
    /** @var  string Event Source Object. Automatically populated. A reference to the event source that this event came from. */
    public $source;
    /** @var  string Sets an event's background and border color just like the calendar-wide eventColor option. */
    public $color;
    /** @var  string Sets an event's background color just like the calendar-wide eventBackgroundColor option. */
    public $backgroundColor;
    /** @var  string Sets an event's border color just like the the calendar-wide eventBorderColor option. */
    public $borderColor;
    /** @var  string Sets an event's text color just like the calendar-wide eventTextColor option. */
    public $textColor;

    /** @var  array Validation rules */
    public $rules = [
        'id'               => '',
        'title'            => 'required',
        'allDay'           => '',
        'start'            => 'required',
        'end'              => '',
        'url'              => '',
        'className'        => '',
        'editable'         => 'boolean',
        'startEditable'    => 'boolean',
        'durationEditable' => 'boolean',
        'rendering'        => '',
        'overlap'          => 'boolean',
        'constraint'       => '',
        'source'           => '',
        'color'            => '',
        'backgroundColor'  => '',
        'borderColor'      => '',
        'textColor'        => '',
    ];

    /**
     * Event constructor.
     * @param $args
     */
    function __construct($args)
    {
        foreach ($args as $key => $value) {
            $this->$key = $value;

            // if we have start and end date keys we need to convert them
            if (in_array($key, ['start', 'end'])) {
                $this->$key = !is_null($value) ? $value->toIso8601String() : null;
            }
        }
    }
}
