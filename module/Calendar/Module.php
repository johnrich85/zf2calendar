<?php
/**
 * Created by JetBrains PhpStorm.
 * User: John
 * Date: 02/10/13
 * Time: 20:14
 * To change this template use File | Settings | File Templates.
 */

namespace Calendar;

use \Zend\Mvc\Controller;

class Module {

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

}