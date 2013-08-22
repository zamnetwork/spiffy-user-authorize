<?php

return array(
    'doctrine' => array(
        'driver' => array(
            'spiffy_user_authorize_orm' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => array(__DIR__ . '/orm')
            ),

            'orm_default' => array(
                'drivers' => array(
                    'SpiffyUserAuthorize\Entity' => 'spiffy_user_authorize_orm',
                )
            )
        )
    ),

    'service_manager' => include 'service.config.php',

    'spiffy_authorize' => array(
        'permission_providers' => array(
            array(
                'name' => 'SpiffyAuthorize\Provider\Permission\ObjectManager\RbacProvider',
                'options' => array(
                    'object_manager' => 'Doctrine\ORM\EntityManager',
                    'target_class'   => 'SpiffyUserAuthorize\Entity\UserResource',
                )
            )
        ),

        'role_providers' => array(
            array(
                'name' => 'SpiffyAuthorize\Provider\Role\ObjectManager\RbacProvider',
                'options' => array(
                    'object_manager' => 'Doctrine\ORM\EntityManager',
                    'target_class'   => 'SpiffyUserAuthorize\Entity\UserRole'
                )
            )
        )
    ),

    'spiffy_user' => array(
        'extensions' => array(
            'authorize' => 'SpiffyUserAuthorize\Extension',
        )
    ),
);