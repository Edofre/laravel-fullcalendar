<?php


namespace Edofre\Fullcalendar;

class Fullcalendar
{
    /**
     * @var string
     */
    protected $id = 'fullcalendar';

    /**
     * Create the <div> the calendar will be rendered into
     *
     * @return string
     */
    public function calendar()
    {
        return "<div id='$this->getId()'></div>";
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
}