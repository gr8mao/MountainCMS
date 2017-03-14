<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.03.17
 * Time: 23:39
 */

ini_set("display_errors",1);
error_reporting(E_ALL);

include_once '../mtn-Config.php';
include_once ROOT . '/mtn-includes/autoload.php';
include_once ROOT.ADMIN_PATH.'/components/AdminRouter.php';


$router = new AdminRouter();
$router->run();