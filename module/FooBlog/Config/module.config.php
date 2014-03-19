<?php

namespace FooBlog;

return array(
    'controllers' => array(
        'invokables' => array(
            'FooBlog\Controller\FooBlog' => 'FooBlog\Controller\FooBlogController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'fooblog' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/blog[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'FooBlog\Controller\FooBlog',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'fooblog' => __DIR__ . '/../view',
        ),
    ),

);