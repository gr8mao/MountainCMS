<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 31.01.17
 * Time: 1:36
 */
class ErrorController // TODO: Rework ErrorController with ErrorsCodes
{
    public static function actionError404() : bool
    {
        echo '404 error!';
        return true;
    }

    public static function actionError500($message = '') : bool
    {
        if ($message) {
            echo " Message: " . $message;
        }
        return true;
    }

    public static function actionError403() : bool
    {
        echo '403 Forbidden';
        return true;
    }

    public static function actionError401() : bool
    {
//        echo '401 Unauthorized';
        return true;
    }

    public static function actionDbError($message = '')
    {
       die($message);
    }

    public static function actionConfigError($message = 'Mountain CMS configuration '){
        die($message);
    }

    public static function actionDirectAccessError($message = ''){
        die($message);
    }
}