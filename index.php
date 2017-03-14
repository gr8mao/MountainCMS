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


include_once 'mtn-Config.php';
include_once ROOT . '/mtn-includes/autoload.php';

$router = new CoreRouter();
$router->run();