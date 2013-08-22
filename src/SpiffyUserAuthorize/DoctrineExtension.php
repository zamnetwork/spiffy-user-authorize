<?php

namespace SpiffyUserAuthorize;

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use SpiffyUser\Entity\UserInterface;
use SpiffyUser\Extension\AbstractExtension;

class DoctrineExtension extends AbstractExtension
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'authorize_doctrine';
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        // disable extension if doctrine extension is not present
        if (!$this->getManager()->has('doctrine')) {
            return;
        }
    }
}