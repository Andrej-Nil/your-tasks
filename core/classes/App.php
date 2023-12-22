<?php

namespace classes;

class App
{
    protected static $container;


    public static function setContainer($container)
    {
        self::$container = $container;
    }

    public static function getContainer(){
        return static::$container;
    }

    public static function get($service) {
            return static::getContainer()->getService($service);
    }
}