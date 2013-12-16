<?php

namespace SpiffyUserAuthorize\Controller;

use SpiffyUser\Extension\Manager;
use SpiffyUserAuthorize\ModuleOptions;
use Symfony\Component\Console\Helper\DialogHelper;
use Zend\Mvc\Controller\AbstractActionController;

class Console extends AbstractActionController
{
    /**
     * @var Manager
     */
    protected $manager;

    /**
     * @var ModuleOptions
     */
    protected $options;

    /**
     * @var \Zend\EventManager\EventManagerInterface
     */
    protected $events;

    /**
     * @throws \RuntimeException
     */
    public function buildRbacAction()
    {
        $manager = $this->getManager();
        $options = $this->getOptions();

        /** @var \SpiffyUserAuthorize\Extension $authorize */
        $authorize     = $manager->get('authorize');
        $resourceClass = $authorize->getOption('user_resource_class');
        $roleClass     = $authorize->getOption('user_role_class');

        /** @var \SpiffyUser\Extension\Doctrine $doctrine */
        $doctrine = $manager->get('doctrine');
        $om       = $doctrine->getObjectManager();
        $roleOr   = $om->getRepository($roleClass);

        foreach ($options->getRoles() as $parent => $children) {
            if (is_int($parent)) {
                $parent   = $children;
                $children = [];
            }

            $roleEntity = $roleOr->findOneBy(['name' => $parent]);

            if (!$roleEntity) {
                $roleEntity = new $roleClass();
                $roleEntity->setName($parent);
                $om->persist($roleEntity);
                $om->flush();
            }

            foreach ($children as $child) {
                $childEntity = $roleOr->findOneBy(['name' => $child]);

                if (!$childEntity) {
                    $childEntity = new $roleClass();
                    $childEntity->setName($child);
                    $om->persist($childEntity);
                    $om->flush();
                }

                $childEntity->setParent($roleEntity);
            }
        }

        $resourceOr = $om->getRepository($resourceClass);

        foreach ($options->getResources() as $role => $resources) {
            /** @var \SpiffyUserAuthorize\Entity\Role $role */
            $roleEntity = $roleOr->findOneBy(['name' => $role]);

            if (!$roleEntity) {
                throw new \RuntimeException('missing a role definition for ' . $role);
            }

            foreach ($resources as $resource) {
                $permEntity = $resourceOr->findOneBy(['name' => $resource]);

                if (!$permEntity) {
                    $permEntity = new $resourceClass();
                    $permEntity->setName($resource);
                    $om->persist($permEntity);
                }

                if ($roleEntity->getResources() && !$roleEntity->getResources()->contains($permEntity)) {
                    $roleEntity->getResources()->add($permEntity);
                }
            }
        }

        $om->flush();
    }

    /**
     * @param Manager $manager
     * @return $this
     */
    public function setManager(Manager $manager)
    {
        $this->manager = $manager;
        return $this;
    }

    /**
     * @return Manager
     */
    public function getManager()
    {
        if (!$this->manager instanceof Manager) {
            $this->setManager($this->getServiceLocator()->get('SpiffyUser\Extension\Manager'));
        }
        return $this->manager;
    }

    /**
     * @param \SpiffyUserAuthorize\ModuleOptions $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return \SpiffyUserAuthorize\ModuleOptions
     */
    public function getOptions()
    {
        if (!$this->options instanceof ModuleOptions) {
            $this->setOptions($this->getServiceLocator()->get('SpiffyUserAuthorize\ModuleOptions'));
        }
        return $this->options;
    }
}