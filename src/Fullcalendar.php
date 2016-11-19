<?php

namespace Edofre\Fullcalendar;

use Illuminate\View\Factory;

/**
 * Class Fullcalendar
 * @package Edofre\Fullcalendar
 */
class Fullcalendar
{
    /** @var string */
    protected $id = 'fullcalendar';
    /** @var array */
    protected $events = [];
    /** @var array */
    protected $defaultOptions = [
        'header'   => [
            'left'   => 'prev,next today',
            'center' => 'title',
            'right'  => 'month,agendaWeek,agendaDay',
        ],
        'firstDay' => 1,
    ];
    /** @var array */
    protected $clientOptions = [];
    /** @var array */
    protected $callbacks = [];

    /**
     * @param Factory $view
     */
    public function __construct(Factory $view)
    {
        $this->view = $view;
    }

    /**
     * @return string
     */
    public function generate()
    {
        return $this->calendar() . $this->script();
    }

    /**
     * Create the <div> the calendar will be rendered into
     * @return string
     */
    private function calendar()
    {
        return "<div id='" . $this->getId() . "'></div>";
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the <script> block to render the calendar
     * @return \Illuminate\View\View
     */
    private function script()
    {
        return $this->view->make('fullcalendar::script', [
            'id'           => $this->getId(),
            'options'      => $this->getOptionsJson(),
            'include_gcal' => config('laravel-fullcalendar.enable_gcal'),
        ]);
    }

    /**
     * @return string
     */
    public function getOptionsJson()
    {
        $options = $this->getOptions();
        $placeholders = $this->getCallbackPlaceholders();

        if (!isset($options['events'])) {
            $options['events'] = $this->events;
        }

        $parameters = array_merge($options, $placeholders);
        $json = json_encode($parameters);
        if ($placeholders) {
            return $this->replaceCallbackPlaceholders($json, $placeholders);
        }

        return $json;
    }

    /**
     * Get the fullcalendar options (not including the events list)
     * @return array
     */
    public function getOptions()
    {
        return array_merge($this->defaultOptions, $this->clientOptions);
    }

    /**
     * Generate placeholders for callbacks, will be replaced after JSON encoding
     *
     * @return array
     */
    protected function getCallbackPlaceholders()
    {
        $callbacks = $this->getCallbacks();
        $placeholders = [];
        foreach ($callbacks as $name => $callback) {
            $placeholders[$name] = '[' . md5($callback) . ']';
        }
        return $placeholders;
    }

    /**
     * @return array
     */
    public function getCallbacks()
    {
        return $this->callbacks;
    }

    /**
     * @param array $callbacks
     */
    public function setCallbacks(array $callbacks)
    {
        $this->callbacks = $callbacks;
    }

    /**
     * Replace placeholders with non-JSON encoded values
     * @param $json
     * @param $placeholders
     * @return string
     */
    protected function replaceCallbackPlaceholders($json, $placeholders)
    {
        $search = [];
        $replace = [];
        foreach ($placeholders as $name => $placeholder) {
            $search[] = '"' . $placeholder . '"';
            $replace[] = $this->getCallbacks()[$name];
        }
        return str_replace($search, $replace, $json);
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->clientOptions = $options;
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Array of events or a route that will provide json events
     * @param mixed $events
     */
    public function setEvents($events)
    {
        $this->events = $events;
    }
}