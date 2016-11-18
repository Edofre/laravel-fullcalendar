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
        'header' => [
            'left'   => 'prev,next today',
            'center' => 'title',
            'right'  => 'month,agendaWeek,agendaDay',
        ],
    ];
    /** @var array */
    protected $clientOptions = [

    ];

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
     *
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
     * @return \Illuminate\View\View
     */
    private function script()
    {
        $options = $this->getOptionsJson();
        return $this->view->make('fullcalendar::script', [
            'id'      => $this->getId(),
            'options' => $options,
        ]);
    }

    /**
     * @return string
     */
    public function getOptionsJson()
    {
        $options = $this->getOptions();
        if (!isset($options['events'])) {
            $options['events'] = $this->events;
        }
        return json_encode($options);
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
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->clientOptions = $options;
    }

}