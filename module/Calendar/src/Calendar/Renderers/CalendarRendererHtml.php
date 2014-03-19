<?php
/**
 * Created by JetBrains PhpStorm.
 * User: John
 * Date: 14/12/13
 * Time: 20:34
 * To change this template use File | Settings | File Templates.
 */

namespace Calendar\Renderers;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class CalendarRendererHtml implements CalendarRendererInterface,ServiceLocatorAwareInterface {

    use ServiceLocatorAwareTrait;

    var $calendar;
    var $days = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
    var $startDay = 1;
    var $dayCounter = 1;


    public function __construct($calendar, $phpRenderer) {
        $this->calendar = $calendar;
        $this->phpRenderer = $phpRenderer;
    }

    /**
     *
     * Returns array of table headers
     *
     * @return array
     */
    public function getHeader() {
        return $this->days;
    }

    public function getDays() {
        $cal = array();
        $dayCount = 0;

        $days = $this->calendar->getDays();
        $dayCountPlusEmptyDays = $this->calendar->getStartDay() + count($days);

        for($a=0; $a < $dayCountPlusEmptyDays; $a++) {
            $this->setDayCounter($this->getDayCounter() + 1);

            if ( $a >= $this->calendar->getStartDay() ) {
                $cal[$a] = $days[$dayCount];
                $dayCount++;
            }
            else {
                $cal[$a] = array('day'=>'&nbsp;');
            }

            if ( $this->getDayCounter() > 7 ) {
                $this->setDayCounter(1);
                $cal[$a]['end_week'] = true;
            }
        }



        return $cal;
    }

    //todo: fix dependencies
    public function render() {

        // Define our template file as form for resolver to map.
        $map = new Resolver\TemplateMapResolver(array(
            'calendar/month' => __DIR__ . '/../../../view/calendar/month.phtml',
            'template/html-head' => __DIR__ . '/../../../view/templates/html-head.phtml',
            'layout/layout' => __DIR__ . '/../../../../Application/view/layout/layout.phtml',
        ));

        // Define the render instance responsible for rendering the form.
        $this->phpRenderer->setResolver(new Resolver\TemplateMapResolver($map));

        // The form view model will generate the form; parsing the vars to it.
        $view = new ViewModel();
        $view->setVariable('calendar', $this->calendar);
        $view->setVariable('days', $this->getDays());
        $view->setTemplate('calendar/month');

        $headerView = new ViewModel(array(
            'cols' => $this->getHeader()
        ));
        $headerView->setTemplate('template/html-head');

        $view->addChild($headerView, 'header');

        return $this->phpRenderer->render($view);

    }


    /**
     * @param int $dayCounter
     */
    public function setDayCounter($dayCounter)
    {
        $this->dayCounter = $dayCounter;
    }

    /**
     * @return int
     */
    public function getDayCounter()
    {
        return $this->dayCounter;
    }
}