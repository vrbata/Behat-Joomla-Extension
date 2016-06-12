<?php

namespace Symla\Behat\JoomlaExtension\Context\Initializer;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Initializer\ContextInitializer;
use Symla\Behat\JoomlaExtension\Context\JoomlaAwareContext;

class JoomlaAwareInitializer implements ContextInitializer
{
    private $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Initializes provided context.
     *
     * @param Context $context
     */
    public function initializeContext(Context $context)
    {
        if (!$context instanceof JoomlaAwareContext) {
            return;
        }

        $context->setJoomlaParameters($this->parameters);
    }
}