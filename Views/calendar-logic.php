<?php

$calendar = new Calendar(date("Y-m-d"));

if ($keeper->getFreeTimePeriod() != null) {
    foreach ($keeper->getFreeTimePeriod() as $event) {
        $time1 = new DateTime($event->getStartDate());
        $time2 = new DateTime($event->getFinalDate());
        $interval = $time1->diff($time2);
        $calendar->add_event('Free', $time1->format('Y-m-d'), $interval->format('%a'), 'green');
    }
}
if($HiredTimePeriod != null){
    foreach ($HiredTimePeriod as $event) {
        $time1 = new DateTime($event->getStartDate());
        $time2 = new DateTime($event->getFinalDate());
        $interval = $time1->diff($time2);
        $calendar->add_event('Hired', $time1->format('Y-m-d'), $interval->format('%a'), 'red');
    }
}

?>