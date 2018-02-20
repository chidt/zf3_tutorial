<?php
namespace User;

use User\Factory\AuthenticationServiceFactory;
use User\Factory\UserAuthenticationControllerFactory;
use Zend\Authentication\AuthenticationService;

return [
    'service_manager' => [
        'factories' => [
            AuthenticationService::class => AuthenticationServiceFactory::class
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\UserAuthenticationController::class => UserAuthenticationControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'login' => [
                'type'    => 'Literal',
                'options' => [
                    // Change this to something specific to your module
                    'route'    => '/login',
                    'defaults' => [
                        'controller'    => Controller\UserAuthenticationController::class,
                        'action'        => 'login',
                    ],
                ],
            ],
            'logout' => [
                'type'    => 'Literal',
                'options' => [
                    // Change this to something specific to your module
                    'route'    => '/logout',
                    'defaults' => [
                        'controller'    => Controller\UserAuthenticationController::class,
                        'action'        => 'logout',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'ZendSkeletonModule' => __DIR__ . '/../view',
        ],
    ],
    //Use community zend-layout-change plugin, change layout per module
    'module_layouts' => [
        'User' => 'layout/login-layout',
    ],
];
