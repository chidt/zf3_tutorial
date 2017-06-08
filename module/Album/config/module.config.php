<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 22/05/2017
 * Time: 10:42
 */

namespace Album;

use Zend\Router\Http\Segment;

return [

    'router' => [
        'routes' => [
            'album' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/album[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AlbumController::class,
                        'action' => 'index'
                    ]
                ]
            ]
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ]
    ]
];

