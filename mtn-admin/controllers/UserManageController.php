<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 01.04.17
 * Time: 20:14
 */
class UserManageController
{
    // new
    public function actionIndex($page = 1){
        if(User::checkLogged() and User::checkUserAdmin($_COOKIE['User'])){
            $username = User::getUsernameById($_COOKIE['User']);

            $count = User::getUserCount();

            $pagination = false;
            if ($count > 5) {
                $pagination = new Pagination($count, $page, 5, 'page-');
            }

            if($page == ''){
                $page = 1;
            }

            $users = User::getUsers($page);

            include_once MTN_ROOT . MTN_ADMIN . TEMPLATES_PATH . '/userManageTemplates/userManageTemplate.php';
        } else {
            header('Location: /mtn-admin/login');
        }

        return true;
    }

    public function actionAddNew()
    {
        if(User::checkLogged() and User::checkUserAdmin($_COOKIE['User'])){
            $username = User::getUsernameById($_COOKIE['User']);

            include_once MTN_ROOT . MTN_ADMIN . TEMPLATES_PATH . '/userManageTemplates/addUserTemplate.php';
        } else {
            header('Location: /mtn-admin/login');
        }

        return true;
    }
}