<?php
/**
 * Created by JetBrains PhpStorm.
 * User: John
 * Date: 02/10/13
 * Time: 21:15
 * To change this template use File | Settings | File Templates.
 */

namespace Calendar\Providers;


class DayProvider implements DayProviderInterface{

    public function createDay($day) {
        //to do

        return array(
            "day" => $day
        );
    }
}