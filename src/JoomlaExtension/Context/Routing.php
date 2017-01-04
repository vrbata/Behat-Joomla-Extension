<?php

namespace Symla\Behat\JoomlaExtension\Context;

trait Routing
{
    protected $joomlaParameters;

    public function setJoomlaParameters(array $parameters)
    {
        $this->joomlaParameters = $parameters;
    }

    public function baseUrl()
    {
        return $this->joomlaParameters['base_url'];
    }

    public function relativeBaseUrl()
    {
        $parsedUrl = parse_url($this->joomlaParameters['base_url']);

        return rtrim($parsedUrl['path'], "/");
    }

    public function route($path)
    {
        return str_replace($this->relativeBaseUrl(), '', \JRoute::_($path));
    }
}