<?php


namespace Album;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;





return [

    /**
     *  
     * 在module/album/src/model.php 加了    
     *  
           public function getControllerConfig()
            {
                return [
                    'factories' => [
                        Controller\AlbumController::class => function($container) {
                            return new Controller\AlbumController(
                                $container->get(Model\AlbumTable::class)
                            );
                        },
                    ],
                ];
            }


          则这句可以不用写 ,
          这两段 相同作用  
            'controllers' => [
                'factories' => [
                    Controller\AlbumController::class => InvokableFactory::class, #albumcontroller.php
                ],
            ],
    */



    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'album' => [  # route 名字
                'type'    => Segment::class,
                'options' => [
                    'route' => '/album[/:action[/:id]]', # 在网址输入 /album/action/id 时会调用这里 如果action=edit 则调用AlbumController.php里 edit()方法
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*', #传入值规则
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AlbumController::class, # 控制器名字 AlbumController.php
                        'action'     => 'index', #默认route
                    ],
                ],
            ],

           
        ],


    ],

    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
];
