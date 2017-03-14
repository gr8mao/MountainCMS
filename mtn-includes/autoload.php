<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 22.01.17
 * Time: 16:42
 *
 * Autoloader
 *
 * @param $class - including class
 *
 */

spl_autoload_register(function($class)
{
    $path_array = array(
        CORE_PATH.'/models/',
        CORE_PATH.'/components/',
        '/mtn-includes/'
    );

    foreach($path_array as $path)
    {
        $path =  ROOT . $path . $class .'.php';
        if(file_exists($path))
        {
            include_once $path;
        }
    }
});