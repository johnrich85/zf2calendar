<?php
/**
 * Created by JetBrains PhpStorm.
 * User: John
 * Date: 15/10/13
 * Time: 21:37
 * To change this template use File | Settings | File Templates.
 */

namespace Calendar\TimeUnits;


class Month {

    protected $month;
    protected $days = array(
        1 => 31,
        2 => 28,
        3 => 31,
        4 => 30,
        5 => 31,
        6 => 30,
        7 => 31,
        8 => 31,
        9 => 30,
        10 => 31,
        11 => 30,
        12 => 31,
    );

    public function __construct($month) {

        $this->month = $month;

    }

    public function getNumDays($isLeap) {

        if ($isLeap && $this->month = 2) {
            return $this->days[$this->month] + 1;
        }
        else {
            return $this->days[$this->month];
        }
    }

    public function getStartDay($year) {
        $dateString = sprintf('%04d-%02d-01', $year->getValue(), $this->month);
        $datetime = new \DateTime($dateString);

        return (int) $datetime->format('N');

    }
}