<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 31.01.17
 * Time: 1:36
 */
class ErrorController
{
    public static function actionError404()
    {
        echo '404 error!';
        return true;
    }

    public static function actionError500()
    {
        echo '500 error!';
        return true;
    }
}