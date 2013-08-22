<?php

namespace SpiffyUserAuthorize;

use SpiffyUser\Extension\AbstractExtension;

class Extension extends AbstractExtension
{
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