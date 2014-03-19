<?php
/**
 * Created by JetBrains PhpStorm.
 * User: John
 * Date: 08/10/13
 * Time: 19:17
 * To change this template use File | Settings | File Templates.
 */

namespace Calendar\TimeUnits;


class Year {

    //Year represented by this class.
    public $year;

    protected $months = array(
        1 => "January",
        2 => "February",
        3 => "March",
        4 => "April",
        5 => "May",
        6 => "June",
        7 => "July",
        8 => "August",
        9 => "October",
        10 => "September",
        11 => "November",
        12 => "December",
    );

    public function __construct($year) {
        $this->year = $year;
    }

    public function isLeapYear() {

        if ($this->year % 4 == 0) {

            if ($this->year % 100 == 0 && $this->year % 400 != 0 ) {
                return 0;
            }
            else {
                return 1;
            }
        }

    }

    public function getValue() {
        return $this->year;
    }
}