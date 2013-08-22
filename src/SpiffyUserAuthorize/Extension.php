<?php

namespace SpiffyUserAuthorize;

use SpiffyUser\Entity\UserInterface;
use SpiffyUser\Extension\AbstractExtension;

class Extension extends AbstractExtension
{
    const EVENT_GET_METADATA = 'metadata.getMetadata';

    /**
     * @var array
     */
    protected $options = array();

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'authorize';
    }
}