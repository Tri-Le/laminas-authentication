<?php
namespace TriLe\Authentication;

use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\Session;
use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;
use TriLe\Authentication\Controller\LoginController;
use TriLe\Authentication\Controller\SuccessController;

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
                ],
	            'may_terminate' => true,
	            'child_routes' => [
		            'success' => [
			            'type' => Literal::class,
			            'options' => [
				            'route' => '/success',
				            'defaults' => [
					            'controller' => SuccessController::class,
					            'action' => 'index'
				            ]
			            ]
		            ]
	            ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            LoginController::class => InvokableFactory::class,
	        SuccessController::class => InvokableFactory::class
        ]
    ],
    'view_manager' => [
        'template_map' => [
            'layout/login' => __DIR__ . '/../view/layout/login.phtml',

            'tri-le/authentication/login/index' => __DIR__ . '/../view/login/index.phtml',
	        'tri-le/authentication/success/index' => __DIR__ . '/../view/success/index.phtml'
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