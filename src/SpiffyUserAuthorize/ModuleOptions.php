<?php

namespace SpiffyUserAuthorize;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    /**
     * An array of roles for the builder. Keys are the parent roles and
     * values are any children roles.
     *
     * @var array
     */
    protected $roles = [];

    /**
     * An array of resources for the builder. Keys are the role that the
     * resource belongs to.
     *
     * @var array
     */
    protected $resources = [];

    /**
     * @param array $resources
     * @return $this
     */
    public function setResources($resources)
    {
        $this->resources = $resources;
        return $this;
    }

    /**
     * @return array
     */
    public function getResources()
    {
        return $this->resources;
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