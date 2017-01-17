<?php

namespace Symla\Behat\JoomlaExtension\Context;

class JoomlaContext implements JoomlaAwareContext
{
    protected $joomlaParameters;

    public function setJoomlaParameters(array $parameters)
    {
        $this->joomlaParameters = $parameters;
    }
}