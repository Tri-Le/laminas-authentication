<?php
namespace TriLe\Authentication;

use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\Session;
use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;
use TriLe\Authentication\Controller\LogInController;
use TriLe\Authentication\Controller\LogOutController;
use TriLe\Authentication\Controller\SuccessController;

return [
    'router' => [
        'routes' => [
            'log-in' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/log-in',
                    'defaults' => [
                        'controller' => LogInController::class,
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
            ],
	        'logout' => [
		        'type' => Literal::class,
		        'options' => [
			        'route' => '/logout',
			        'defaults' => [
				        'controller' => LogOutController::class,
				        'action' => 'index'
			        ]
		        ],
		        ]
        ]
    ],
    'controllers' => [
        'factories' => [
            LogInController::class => InvokableFactory::class,
	        LogOutController::class => InvokableFactory::class,
	        SuccessController::class => InvokableFactory::class
        ]
    ],
    'view_manager' => [
        'template_map' => [
            'layout/log-in' => __DIR__ . '/../view/layout/login.phtml',

            'tri-le/authentication/log-in/index' => __DIR__ . '/../view/log-in/index.phtml',
	        'tri-le/authentication/success/index' => __DIR__ . '/../view/success/index.phtml'
        ]
    ],
    'service_manager' => [
        'factories' => [
            AuthenticationService::class => AuthenticationServiceFactory::class
        ]
    ],
    'authentication' => [
	    'table_name' => 'w_users',
	    'identity_column' => 'email',
	    'credential_column' => 'password',
	    'credential_treatment' => '?',
        'storage' => [
            'name' => Session::class,
            'options' => [
                'name' => 'Authentication'
            ]
        ]
    ]
];