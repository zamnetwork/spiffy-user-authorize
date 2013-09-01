<?php

namespace SpiffyUserAuthorize;

use SpiffyUser\Extension\AbstractExtension;

class Extension extends AbstractExtension
{
    /**
     * @var array
     */
    protected $options = [
        'user_resource_class' => 'SpiffyUserAuthorize\Entity\UserResource',
        'user_role_class'     => 'SpiffyUserAuthorize\Entity\UserRole',
    ];

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'authorize';
    }
}