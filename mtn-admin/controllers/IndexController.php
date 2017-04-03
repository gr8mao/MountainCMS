<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.03.17
 * Time: 23:50
 */
class IndexController
{
    public function actionIndex()
    {
        if(User::checkLogged() and User::checkUserAdmin($_COOKIE['User'])){
            $username = User::getUsernameById($_COOKIE['User']);
            include_once MTN_ROOT.MTN_ADMIN.TEMPLATES_PATH.'/indexTemplate.php';
        } else {
            header('Location: /mtn-admin/login');
        }

        return true;
    }

}