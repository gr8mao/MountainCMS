<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 22.01.17
 * Time: 16:11
 *
 * Front-Controller
 *
 */


define('ROOT', dirname(__FILE__).'/mtn-core'); // define ROOT directory

include_once ROOT . '/components/Router.php';
include_once ROOT . '/components/autoload.php';

$router = new Router();
$router->run();