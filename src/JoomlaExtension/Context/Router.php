<?php

namespace Symla\Behat\JoomlaExtension\Context;

abstract class Router
{
    private static $parameters;

    public static function initialize(array $parameters)
    {
        static::$parameters = $parameters;
    }

    public static function baseUrl()
    {
        return static::$parameters['base_url'];
    }

    public static function relativeBaseUrl()
    {
        $parsedUrl = parse_url(static::$parameters['base_url']);

        return rtrim($parsedUrl['path'], "/");
    }

    public static function route($path)
    {
        return str_replace(static::relativeBaseUrl(), '', \JRoute::_($path, false));
    }
}