<?php

namespace Symla\Behat\JoomlaExtension\Context;

trait JoomlaTrait
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

    public function loadAdministratorLanguage()
    {
        $this->loadLanguage('administrator');
    }

    public function loadSiteLanguage()
    {
        $this->loadLanguage('site');
    }

    private function loadLanguage($type = 'site')
    {
        $params   = \JComponentHelper::getParams('com_languages');
        $language = $params->get($type, 'en-GB');
        $lang     = \JLanguage::getInstance($language);

        \JFactory::$language = $lang;
    }
}