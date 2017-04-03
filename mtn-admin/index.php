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
include_once MTN_ROOT . MTN_INC . '/autoload.php';
include_once MTN_ROOT . MTN_ADMIN . '/components/AdminRouter.php';

if (User::checkLogged()) {
    Database::initConnection();
    if(User::checkUserAdmin($_COOKIE['User'])){
        $router = new AdminRouter();
        $router->run();
    } else {
        ErrorController::actionError403();
    }
} else {
    ErrorController::actionError401();
    header('Location: /login');
}
