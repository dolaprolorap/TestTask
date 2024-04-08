<?php

namespace app\components;

use yii\base\BaseObject;

class ScheduleMaker extends BaseObject
{
    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();
    }

    /**
     * Make schedule by meeting's list $sheduleArr
     * 
     * @param Array $scheduleArr Array of format 
     * { 
     *  "id": number,
     *  "date": "yyyy-mm-dd",
     *  "start_time": "hh:mm:00",
     *  "end_time": "hh:mm:00"
     * }
     * 
     * @return Array Optimal schedule - array has the same format as the parameter array
     */
    public function make($scheduleArr) {
        // Array of optimal schedule
        $optimalSchedule = [];
        // Conformity array between id of meeting (key) and meeting (value)
        $conformityArr = [];
        foreach($scheduleArr as $meeting) {
            $conformityArr[$meeting["id"]] = $meeting;
        }

        // Array of meetings, where start and end time converted to minutes
        $convertedScheduleArr = [];
        foreach($scheduleArr as $meeting) {
            [$start_hour, $start_minute] = preg_split('/[ :]/', $meeting["start_time"]);
            [$end_hour, $end_minute] = preg_split('/[ :]/', $meeting["end_time"]);
            $convertedScheduleArr[] = [
                "start" => (int) $start_hour * 60 + $start_minute,
                "end" => (int) $end_hour * 60 + $end_minute,
                "id" => $meeting["id"]
            ];
        }

        // Sort by start time
        usort($convertedScheduleArr, function($a, $b) {
            if($a["start"] > $b["start"]) return 1;
            if($a["start"] < $b["start"]) return -1;
            return 0;
        });

        $lastElem = null;
        foreach($convertedScheduleArr as $meeting) {
            // For one meeting - optimal schedule is the meeting itself
            if(count($optimalSchedule) == 0) {
                $optimalSchedule[] = $meeting;
                $lastElem = $meeting;
            }
            else {
                // If last meeting endtime is bigger than the current one, replace last 
                // meeting with current
                if($meeting["end"] <= $lastElem["end"]) {
                    array_pop($optimalSchedule);
                    $optimalSchedule[] = $meeting;
                    $lastElem = $meeting;
                }
                // Otherwise if meetings dont interact, push current meeting to the
                // optimal schedule
                else if ($meeting["start"] >= $lastElem["end"]){
                    $optimalSchedule[] = $meeting;
                    $lastElem = $meeting;
                }
            }
        }

        // Return meetings in format of $scheduleArr
        return array_map(fn($value) => $conformityArr[$value["id"]], $optimalSchedule);
    }
}