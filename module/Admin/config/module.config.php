<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonAdmin for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
//use Zend\Router\Http\Regex;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/admin[/:action[/:id]]',
                    'defaults' => [
                        'controller'    => Controller\AdminController::class,
                        'action'        => 'index',
                    ],
                ],
            ],


            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/login',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
            'logout' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/logout',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],
            'not-authorized' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/not-authorized',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'notAuthorized',
                    ],
                ],
            ],
            'reset-password' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/reset-password',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'resetPassword',
                    ],
                ],
            ],
            'set-password' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/set-password',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'setPassword',
                    ],
                ],
            ],
            'users' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/users[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller'    => Controller\UserController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
            'roles' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/roles[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ],
                    'defaults' => [
                        'controller'    => Controller\RoleController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
            'permissions' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/permissions[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ],
                    'defaults' => [
                        'controller'    => Controller\PermissionController::class,
                        'action'        => 'index',
                    ],
                ],
            ],

            'apropos' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/apropos[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ],
                    'defaults' => [
                        'controller'    => Controller\AproposController::class,
                        'action'        => 'index',
                    ],
                ],
            ],


            'clients' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/clients[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ],
                    'defaults' => [
                        'controller'    => Controller\ClientController::class,
                        'action'        => 'index',
                    ],
                ],
            ],


            'messages' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/messages[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ],
                    'defaults' => [
                        'controller'    => Controller\MessageController::class,
                        'action'        => 'index',
                    ],
                ],
            ],

            'slides' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/slides[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ],
                    'defaults' => [
                        'controller'    => Controller\SlidesController::class,
                        'action'        => 'index',
                    ],
                ],
            ],

            
             'parametres' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/parametres',
                    'defaults' => [
                        'controller' => Controller\ParametresController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'contactForm' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/contact-form',
                    'defaults' => [
                        'controller' => Controller\AdminController::class,
                        'action'     => 'contactForm',
                    ],
                ],
            ],
            'formations' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/formations',
                    'defaults' => [
                        'controller' => Controller\AdminController::class,
                        'action'     => 'formations',
                    ],
                ],
            ],
            
//            'download' => [
//                'type'    => Segment::class,
//                'options' => [
//                    'route'    => '/download[/:action]',
//                    'defaults' => [
//                        'controller'    => Controller\DownloadController::class,
//                        'action'        => 'index',
//                    ],
//                ],
//            ],
//            'static' => [
//                'type' => StaticRoute::class,
//                'options' => [
//                    'dir_name'         => __DIR__ . '/../view',
//                    'template_prefix'  => 'Admin/index/static',
//                    'filename_pattern' => '/[a-z0-9_\-]+/',
//                    'defaults' => [
//                        'controller' => Controller\IndexController::class,
//                        'action'     => 'static',
//                    ],                    
//                ],
//            ],          
        ],
    ],
    'controllers' => [
        'factories' => [
            //Controller\IndexController::class => InvokableFactory::class,
            Controller\AdminController ::class => Controller\Factory\AdminControllerFactory::class,
            Controller\ParametresController ::class => Controller\Factory\ParametresControllerFactory::class,
            Controller\SlidesController ::class => Controller\Factory\SlidesControllerFactory::class,
            Controller\AproposController ::class => Controller\Factory\AproposControllerFactory::class,
            Controller\ClientController ::class => Controller\Factory\ClientControllerFactory::class,
            Controller\MessageController ::class => Controller\Factory\MessageControllerFactory::class,

            Controller\AuthController::class => Controller\Factory\AuthControllerFactory::class,
            Controller\PermissionController::class => Controller\Factory\PermissionControllerFactory::class,
            Controller\RoleController::class => Controller\Factory\RoleControllerFactory::class,    
            Controller\UserController::class => Controller\Factory\UserControllerFactory::class, 
            
        ],
    ],

    // We register module-provided controller plugins under this key.
    'controller_plugins' => [
        'factories' => [
            Controller\Plugin\AccessPlugin::class => Controller\Plugin\Factory\AccessPluginFactory::class,
            Controller\Plugin\CurrentUserPlugin::class => Controller\Plugin\Factory\CurrentUserPluginFactory::class,
        ],
        'aliases' => [
            'access' => Controller\Plugin\AccessPlugin::class,
            'currentUser' => Controller\Plugin\CurrentUserPlugin::class,
        ],
    ],


    // The following registers our custom view 
    // helper classes in view plugin manager.
    'view_helpers' => [
        'factories' => [
            View\Helper\Menu::class => View\Helper\Factory\MenuFactory::class,
            View\Helper\Breadcrumbs::class => InvokableFactory::class,
        ],
        'aliases' => [
            'mainMenu' => View\Helper\Menu::class,
            'pageBreadcrumbs' => View\Helper\Breadcrumbs::class,
        ],
    ],

    'access_filter' => [
        'controllers' => [
            Controller\ParametresController::class => [
                // Give access to "resetPassword", "message" and "setPassword" actions
                // to anyone.
                ['actions' => ['contact', 'galerie', 'listeFormations', 
                'contactForm', 'nousConnaitre', 'index', 'voirSection', 
                'ajouterFormations', 'editerFormations'], 'allow' => '*'],
                // Give access to "index", "add", "edit", "view", "changePassword" actions to users having the "user.manage" permission.
                ['actions' => '*', 'allow' => '@']
            ],
            Controller\SlidesController::class => [
                // Give access to "resetPassword", "message" and "setPassword" actions
                // to anyone.
                ['actions' => ['contact', 'galerie', 'listeFormations', 
                'contactForm', 'nousConnaitre', 'index', 'voirSection', 
                'ajouterFormations', 'editerFormations'], 'allow' => '*'],
                // Give access to "index", "add", "edit", "view", "changePassword" actions to users having the "user.manage" permission.
                ['actions' => '*', 'allow' => '@']
            ],
            Controller\AdminController::class => [
                // Give access to "resetPassword", "message" and "setPassword" actions
                // to anyone.
                ['actions' => ['contact', 'galerie', 'listeFormations', 
                'contactForm', 'nousConnaitre', 'index', 'voirSection', 
                'ajouterFormations', 'editerFormations'], 'allow' => '*'],
                // Give access to "index", "add", "edit", "view", "changePassword" actions to users having the "user.manage" permission.
                ['actions' => '*', 'allow' => '@']
            ],
            Controller\UserController::class => [
                // Give access to "resetPassword", "message" and "setPassword" actions
                // to anyone.
                ['actions' => ['resetPassword', 'message', 'setPassword'], 'allow' => '*'],
                // Give access to "index", "add", "edit", "view", "changePassword" actions to users having the "user.manage" permission.
                ['actions' => '*', 'allow' => '@']
            ],
            Controller\RoleController::class => [
                // Allow access to authenticated users having the "role.manage" permission.
                ['actions' => '*', 'allow' => '@']
            ],
            Controller\PermissionController::class => [
                // Allow access to authenticated users having "permission.manage" permission.
                ['actions' => '*', 'allow' => '@']
            ],
        ]
    ],
    // This key stores configuration for RBAC manager.
    'rbac_manager' => [
        'assertions' => [Service\RbacAssertionManager::class],
    ],

    'service_manager' => [
        'factories' => [
            Service\ServiceManager::class => Service\Factory\ServiceManagerFactory::class,

            Service\NavManager::class => Service\Factory\NavManagerFactory::class,
            Service\RbacManager::class => Service\Factory\RbacManagerFactory::class,
            Service\RbacAssertionManager::class => Service\Factory\RbacAssertionManagerFactory::class,

            \Laminas\Authentication\AuthenticationService::class => Service\Factory\AuthenticationServiceFactory::class,
            Service\AuthAdapter::class => Service\Factory\AuthAdapterFactory::class,
            Service\AuthManager::class => Service\Factory\AuthManagerFactory::class,
            Service\PermissionManager::class => Service\Factory\PermissionManagerFactory::class,
            Service\RoleManager::class => Service\Factory\RoleManagerFactory::class,
            Service\UserManager::class => Service\Factory\UserManagerFactory::class,

           
            
            //Service\BordereauManager ::class => Service\Factory\BordereauManagerFactory::class,
        ],
    ],

    // The following key allows to define custom styling for FlashMessenger view helper.
    'view_helper_config' => [
        'flashmessenger' => [
            'message_open_format'      => '<div%s><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>',
            'message_close_string'     => '</div>',
            'message_separator_string' => ''
        ]
    ],  

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/admin'           => __DIR__ . '/../view/layout/admin.phtml',
            'admin/index/index' => __DIR__ . '/../view/admin/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        // The following is needed to be able to return JSON response from controller actions.
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
