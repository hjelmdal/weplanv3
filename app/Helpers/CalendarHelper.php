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
            $date = date("Y-m-d");
        }
        $this->obj = new \stdClass();
        $this->real_date = date("Y-m-d");
        $this->timestamp = date("U");
        $this->prev_year = $this->setDate($date)->modify("first day of january last year")->format("Y-m-d");
        $this->this_year = $this->setDate($date)->modify("first day of january this year")->format("Y-m-d");
        $this->next_year = $this->setDate($date)->modify("first day of january next year")->format("Y-m-d");
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
        elseif($type == "year") {
            $this->start = $this->setDate($date)->modify("first day of january this year")->format("Y-m-d");
            $this->end = $this->setDate($date)->modify("last day of december this year")->format("Y-m-d");
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

    public function setProps($activity,$user) {
        if ($user->WePlayer) {
            $player_id = $user->WePlayer->id;
        } else {
            $player_id = false;
        }
        $activity->my_activity = false;
        $activity->response_timestamp = strtotime($activity->response_date . " " . $activity->response_time);
        $activity->confirmed = 0;
        $activity->declined = 0;
        $activity->enrolled = count($activity->players);
        if ($activity->enrolled > 0) {
            foreach ($activity->players as $player) { // Any players enrolled / invited?
                if ($player->id === $player_id) { // My activity ?
                    $activity->my_activity = true;
                    if ($player->pivot->confirmed_at) {
                        $activity->my_status = 2;
                        $activity->response_confirmed = true;
                    } elseif ($player->pivot->declined_at) {
                        $activity->my_status = 0;
                        $activity->response_declined = true;
                    } else {
                        $activity->my_status = 1;
                        $activity->response_missing = true;
                    }
                }

                if ($player->pivot->confirmed_at) {
                    $activity->confirmed++;
                }
                if ($player->pivot->declined_at) {
                    $activity->declined++;
                }
            }
        }
        if($activity->response_timestamp > date("U") && ($activity->type->signup == 1 || $activity->my_activity == true)) {
            $activity->response_allowed = true;
        } else {
            $activity->response_allowed = false;
        }

        return $activity;
    }



}
