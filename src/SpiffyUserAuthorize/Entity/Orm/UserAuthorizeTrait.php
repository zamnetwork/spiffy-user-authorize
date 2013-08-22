<?php

namespace SpiffyUserAuthorize\Entity\Orm;

use Doctrine\ORM\Mapping as ORM;

trait UserAuthorizeTrait
{
    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="SpiffyUserAuthorize\Entity\UserRole", mappedBy="users")
     */
    protected $roles = array();

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }
}