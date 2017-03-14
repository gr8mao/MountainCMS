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

ini_set("display_errors",1);
error_reporting(E_ALL);


define('ROOT', dirname(__FILE__).'/mtn-core'); // define ROOT directory

include_once ROOT . '/components/Router.php';
include_once ROOT . '/components/autoload.php';
include_once ROOT . '/config/systemConfig.php';

$router = new Router();
$router->run();