<?php
/**
 * Created by JetBrains PhpStorm.
 * User: John
 * Date: 21/04/13
 * Time: 12:13
 * To change this template use File | Settings | File Templates.
 */
namespace Album;

// Add these import statements:
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\ControllerManager;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
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

    // Add this method:
    public function getServiceConfig()
    {

    }


    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'Album\Controller\Album' => function(ControllerManager $cm) {
                    return new Controller\AlbumController(
                        $cm->getServiceLocator(),
                        $cm->getServiceLocator()->get('homeCalendar')
                    );
                },
            ),
        );
    }


}
