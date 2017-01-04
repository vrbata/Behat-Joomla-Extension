<?php

namespace Symla\Behat\JoomlaExtension\Context;

use Behat\MinkExtension\Context\MinkContext;

class JoomlaMinkContext extends MinkContext implements JoomlaAwareContext
{
    use Routing;
}