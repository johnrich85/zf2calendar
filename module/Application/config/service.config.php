<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'factories' => array(
        'homeCalendar'  => function($sm) {
            $dayProvider = new Calendar\Providers\DayProvider();
            $calendar = new Calendar\Calendar($dayProvider);
            $calendar->setMonth(3);
            $calendar->setYear(2014);
            $renderer = $sm->get("Zend\View\Renderer\PhpRenderer");
            $calendarRenderer = new \Calendar\Renderers\CalendarRendererHtml($calendar, $renderer);

            return $calendarRenderer;
        }
    )
);



