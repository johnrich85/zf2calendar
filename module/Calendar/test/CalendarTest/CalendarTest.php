<?php
/**
 * Created by JetBrains PhpStorm.
 * User: John
 * Date: 18/03/14
 * Time: 22:31
 * To change this template use File | Settings | File Templates.
 */

namespace AlbumTest\CalendarTest;

use Calendar;
use Calendar\Providers;

class CalendarTest extends \PHPUnit_Framework_TestCase {

    protected function setUp()
    {
        $this->dayProvider = $this->getMock('Calendar\Providers\DayProvider');

        $this->calendar = new Calendar\Calendar($this->dayProvider);
        $this->calendar->setMonth(3);
        $this->calendar->setYear(2014);
    }

    public function testGetDays() {
        $days = $this->calendar->getDays();

        $this->assertCount(31, $days);
        $this->assertInternalType("array", $days);
    }

    public function testGetStartDay() {
        $startDay = $this->calendar->getStartDay();

        $this->assertEquals(5, $startDay);
    }
}