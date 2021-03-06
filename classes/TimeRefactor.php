<?php

class TimeRefactor
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getMonthDay()
    {
        foreach ($this->data as &$field)
        {
            $timestamp = strtotime($field['date']);
            $field['date'] = date('F, jS', $timestamp);
        }

        return $this->data;
    }
}