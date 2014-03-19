<?php
/**
 * Created by JetBrains PhpStorm.
 * User: John
 * Date: 02/10/13
 * Time: 20:19
 * To change this template use File | Settings | File Templates.
 */

namespace Calendar;

class Calendar {

    var $year;
    var $month;
    var $days;
    var $dayProvider;

    public function __construct(Providers\DayProviderInterface $dayProvider) {
        $this->dayProvider = $dayProvider;
    }

    public function getDays() {

        if ($this->month == null){
            throw new \Exception("Month object is not set, please use 'setMonth' to inject the required object.");
        }

        if ($this->year == null){
            throw new \Exception("Year object is not set, please use 'setYear' to inject the required object.");
        }

        for($a=1; $a <= $this->month->getNumDays($this->year->isLeapYear()); $a++) {
            $day = $this->getDay($a);
            $this->days[] = $day;
        }

        return $this->days;
    }

    public function getStartDay() {
        return $this->month->getStartDay($this->year) - 1;
    }

    public function getMonth() {
        return $this->month;
    }

    public function getMonths() {
        //Todo: return array of months in year (month objects?)
    }

    public function getDay($day) {
        //Todo: throw exception if month/day not set.
        return $this->dayProvider->fetchDay($day, $this->month, $this->year);
    }

    public function setMonth($month) {

        if ($month instanceof TimeUnits\Month) {
            $this->month = $month;
        }
        else {
            $this->month = new TimeUnits\Month($month);
        }

    }

    public function setYear($year) {
        if ($year instanceof TimeUnits\Year) {
            $this->year = $year;
        }
        else {
            $this->year = new TimeUnits\Year($year);
        }
    }

}