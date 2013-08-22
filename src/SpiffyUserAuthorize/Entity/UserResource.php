<?php

namespace SpiffyUserAuthorize\Entity;

use SpiffyAuthorize\Permission\PermissionInterface;

class UserResource implements PermissionInterface, UserResourceInterface
{
    /**
     * @var array
     */
    protected $id;

    /**
     * @var array
     */
    protected $name;

    /**
     * @var array
     */
    protected $roles;

    /**
     * @param array $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return array
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param array $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }
}