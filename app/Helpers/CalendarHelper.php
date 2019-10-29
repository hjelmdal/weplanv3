<?php


namespace App\Helpers;


class CalendarHelper
{
    private $date;
    private $cal;
    private $obj;
    public function __construct($date = false,$type = null)
    {
        if($date) {
        }
            if ($this->cal = \DateTime::createFromFormat('Y-m-d', $date) !== FALSE) {
                $this->date = $date;
        }
        else {
            $this->cal = new \DateTime();
        }
        $this->obj = new \stdClass();
        $this->real_date = date("Y-m-d");
        $this->timestamp = date("U");
        $this->prev_month = $this->setDate($date)->modify("first day of last month")->format("Y-m-d");
        $this->this_month = $this->setDate($date)->modify("first day of this month")->format("Y-m-d");
        $this->next_month = $this->setDate($date)->modify("first day of next month")->format("Y-m-d");
        $dayOfWeek = $this->setDate($date)->format("w");
        if ($dayOfWeek == 1) {
            $monday = "This monday";
        } else {
            $monday = "Last monday";
        }

        $this->prev_week = $this->setDate($date)->modify($monday . "- 7 days")->format("Y-m-d");
        $this->this_week = $this->setDate($date)->modify($monday)->format("Y-m-d");
        $this->next_week = $this->setDate($date)->modify($monday  . "+ 7 days")->format("Y-m-d");
        $this->yesterday = $this->setDate($date)->modify("- 1 day")->format("Y-m-d");
        $this->today = $date;
        $this->tomorrow = $this->setDate($date)->modify("+ 1 day")->format("Y-m-d");
        if($type == "week") {

            $this->start = $this->setDate($date)->modify($monday)->format("Y-m-d");
            $this->end = $this->setDate($date)->modify("This sunday")->format("Y-m-d");
        } elseif($type == "month") {
            $this->start = $this->setDate($date)->modify("first day of this month")->format("Y-m-d");
            $this->end = $this->setDate($date)->modify("last day of this month")->format("Y-m-d");
        }
        elseif($type == "day") {
            $this->start = $date;
            $this->end = $date;
        }

        $this->days = array();
        return $this->obj;
    }


    private function setDate($date) {
        if(\DateTime::createFromFormat('Y-m-d', $date) !== FALSE) {
            return new \DateTime($date);
        }
        return false;
    }



}
