<?php

namespace SpiffyUserAuthorize\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use SpiffyUser\Service\AbstractServiceFactory;

class MetadataServiceFactory extends AbstractServiceFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws \InvalidArgumentException
     * @return LoginService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \SpiffyUserAuthorize\ModuleOptions $options */
        $options = $serviceLocator->get('SpiffyUserAuthorize\ModuleOptions');
        $service = new MetadataService();

        foreach ($options->getPlugins() as $plugin) {
            $service->registerPlugin($this->get($serviceLocator, $plugin));
        }

        return $service;
    }
}