<?php
/**
 * Created by JetBrains PhpStorm.
 * User: John
 * Date: 02/10/13
 * Time: 21:16
 * To change this template use File | Settings | File Templates.
 */

namespace Calendar\Providers;


interface DayProviderInterface {
    public function fetchDay($day);
}
