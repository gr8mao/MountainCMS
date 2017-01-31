<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 31.01.17
 * Time: 1:36
 */
class ErrorController
{
    public static function actionError404() : bool
    {
        echo '404 error!';
        return true;
    }

    public static function actionError500($message = '') : bool
    {
        echo '500 error!';
        if ($message) {
            echo " Message: " . $message;
        }
        return true;
    }

    public static function actionDBerrorr($message = '') : bool
    {
        echo 'DB error!';
        if ($message) {
            echo " Message: " . $message;
        }
        return true;
    }
}