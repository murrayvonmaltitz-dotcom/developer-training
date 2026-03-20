<?php

namespace Core;

//makes container availible anywhere in application
class App {
    protected static $container;

    public static function setContainer($container) {
        static::$container = $container;
    }
    
    public static function container() {
        return static::$container;
    }

    public static function bind($key, $resolve) {
        dd($resolve);
        static::container()->bind($key, $resolve);
    }

    public static function resolve($key) {
        return static::container()->resolve($key);
    }
}