<?php

namespace SpiffyUserAuthorize;

use Zend\Console\Adapter\AdapterInterface;
use Zend\Console\ColorInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;

class Module implements
    ConsoleUsageProviderInterface,
    ConfigProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getConsoleUsage(AdapterInterface $console)
    {
        return [
            $console->colorize('Usage:', ColorInterface::YELLOW),
            '  [options] command [arguments]',
            '',
            $console->colorize('Available Commands:', ColorInterface::YELLOW),
            [
                $console->colorize('  spiffyuser build', ColorInterface::GREEN),
                'builds the roles and resources for using default configuration'
            ],
        ];
    }
}