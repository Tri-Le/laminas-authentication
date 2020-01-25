<?php
namespace TriLe\Authentication;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;
use TriLe\Authentication\Controller\LoginController;

return [
    'router' => [
        'routes' => [
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/login',
                    'defaults' => [
                        'controller' => LoginController::class,
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            LoginController::class => InvokableFactory::class
        ]
    ],
    'view_manager' => [
        'template_map' => [
            'layout/login' => __DIR__ . '/../view/layout/login.phtml'
        ]
    ]
];