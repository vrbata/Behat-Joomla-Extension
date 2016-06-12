<?php

namespace Symla\Behat\JoomlaExtension\Context;

use Behat\Behat\Context\Context;

interface JoomlaAwareContext extends Context
{
    public function setJoomlaParameters(array $parameters);
}