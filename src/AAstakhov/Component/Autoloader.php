<?php

namespace AAstakhov\Component;

class Autoloader
{
    public static function load($className)
    {
        $className = ltrim($className, '\\');
        $fileName = '';

        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName = __DIR__.'/../../'.str_replace('\\', DIRECTORY_SEPARATOR, $namespace).DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className).'.php';

        require_once $fileName;
    }

    public static function register()
    {
        spl_autoload_register(array('self', 'load'));
    }

}