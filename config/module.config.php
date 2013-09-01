<?php

return [
    'controllers' => [
        'invokables' => [
            'SpiffyUserAuthorize\Controller\Console' => 'SpiffyUserAuthorize\Controller\Console'
        ]
    ],

    'console' => [
        'router' => [
            'routes' => [
                'spiffyuser:build' => [
                    'options' => [
                        'route' => 'spiffyuser build',
                        'defaults' => [
                            'controller' => 'SpiffyUserAuthorize\Controller\Console',
                            'action'     => 'buildRbac',
                        ],
                    ]
                ]
            ],
        ],
    ],

    'doctrine' => [
        'driver' => [
            'spiffy_user_authorize_orm' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => [__DIR__ . '/orm']
            ],

            'orm_default' => [
                'drivers' => [
                    'SpiffyUserAuthorize\Entity' => 'spiffy_user_authorize_orm',
                ]
            ]
        ]
    ],

    'service_manager' => [
        'factories' => [
            'SpiffyUserAuthorize\ModuleOptions' => 'SpiffyUserAuthorize\ModuleOptionsFactory',
        ]
    ],

    'spiffy_authorize' => [
        'permission_providers' => [
            [
                'name' => 'SpiffyAuthorize\Provider\Permission\ObjectManager\RbacProvider',
                'options' => [
                    'object_manager' => 'Doctrine\ORM\EntityManager',
                    'target_class'   => 'SpiffyUserAuthorize\Entity\UserResource',
                ]
            ]
        ],

        'role_providers' => [
            [
                'name' => 'SpiffyAuthorize\Provider\Role\ObjectManager\RbacProvider',
                'options' => [
                    'object_manager' => 'Doctrine\ORM\EntityManager',
                    'target_class'   => 'SpiffyUserAuthorize\Entity\UserRole'
                ]
            ]
        ]
    ],

    'spiffy_user_authorize' => [
        'roles' => [

        ],

        'resources' => [

        ],
    ],

    'spiffy_user' => [
        'extensions' => [
            'authorize' => 'SpiffyUserAuthorize\Extension',
        ]
    ],
];