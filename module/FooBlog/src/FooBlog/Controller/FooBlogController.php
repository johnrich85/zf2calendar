<?php
/**
 * Created by JetBrains PhpStorm.
 * User: John
 * Date: 21/04/13
 * Time: 12:25
 * To change this template use File | Settings | File Templates.
 */

namespace FooBlog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class FooBlogController extends AbstractActionController
{

    protected $em;

    public function indexAction()
    {
        $calendar = new \Calendar\Calendar();

        return new ViewModel(array(
            'test' => "Hello World"
        ));
}

}
