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
        '/mtn-includes/models/',
        '/mtn-includes/controllers/',
        MTN_CORE.'/components/',
        MTN_ADMIN.'/components/',
        '/mtn-includes/'
    );

    foreach($path_array as $path)
    {
        $path =  MTN_ROOT . $path . $class .'.php';
        if(file_exists($path))
        {
            include_once $path;
        }
    }
});