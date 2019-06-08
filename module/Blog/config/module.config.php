<?php



// In /module/Blog/config/module.config.php:
namespace Blog;

use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;


return [

    /** 配置路由 Route Configuration */ 
    // This lines opens the configuration for the RouteManager
    'router' => [
        // Open configuration for all possible routes
        'routes' => [
            // Define a new route called "blog"
            'blog' => [
                // Define a "literal" route type:
                'type' => Literal::class,
                // Configure the route itself
                'options' => [
                    // Listen to "/blog" as uri:
                    'route' => '/blog',
                    // Define default controller and action to be called when
                    // this route is matched
                    'defaults' => [
                        'controller' => Controller\ListController::class,# 调用Controller\ListController.php 但是会找不到,所以需要下面第39行代码指定
                        'action'     => 'index',
                      
                    ],
                ],
            ],
        ],
    ],

     /** 配置控制器 Controller Configuration */ 
    # tell our module where to find this controller named Blog\Controller\ListController
    'controllers' => [
        'factories' => [
            Controller\ListController::class => InvokableFactory::class, 
        ],
    ],
     /** 配置视图 view Configuration */ 
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],






];
