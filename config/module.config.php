<?php
namespace TriLe\Authentication;

use Laminas\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\Session;
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
    ],
    'service_manager' => [
        'factories' => [
            AuthenticationService::class => AuthenticationServiceFactory::class
        ]
    ],
    'authentication' => [
        'table_name' => 'w_login',
        'identity_column' => 'email',
        'credential_column' => 'password',
        'credential_treatment' => 'SHA256(?)',
        'storage' => [
            'name' => Session::class,
            'options' => [
                'name' => 'Authentication'
            ]
        ]
    ]
];