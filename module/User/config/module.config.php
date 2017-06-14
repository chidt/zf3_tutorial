<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 12/06/2017
 * Time: 11:22
 */
namespace User;
use User\Factory\AuthControllerFactory;
use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;


return [
    'service_manager' => [
        'factories' => [
            \Zend\Authentication\AuthenticationService::class => \User\Factory\AuthenticationServiceFactory::class
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\AuthController::class => AuthControllerFactory::class
//            Controller\AuthController::class => InvokableFactory::class
        ]
    ],
    'router' => [
        'routes' => [
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/login',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action' => 'login'
                    ]
                ]
            ]
        ]
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];