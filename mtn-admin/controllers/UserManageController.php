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
    public function actionIndex($page = 1)
    {
        if (User::checkLogged() and User::checkUserAdmin($_COOKIE['User'])) {
            $username = User::getUsernameById($_COOKIE['User']);

            $count = User::getUserCount();

            $pagination = false;
            if ($count > 5) {
                $pagination = new Pagination($count, $page, 5, 'page-');
            }

            if ($page == '') {
                $page = 1;
            }

            if(isset($_POST['filter'])){
                $users = User::getUsers($page, $_POST['filter']);
                echo json_encode($users);
                return true;
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
        if (User::checkLogged() and User::checkUserAdmin($_COOKIE['User'])) {
            $username = User::getUsernameById($_COOKIE['User']);

            $userroles = User::getUserRoles();

            if (isset($_POST['formId'])) {
                $login = $_POST['login'];
                $password = $_POST['password'];
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $email = $_POST['email'];
                $role = $_POST['userRole'];
                $errors = false;

                if (!User::checkLogin($login)) {
                    $errors[] = 'Логин не может быть короче 4-х символов;';
                }

                if (!User::checkPassword($password)) {
                    $errors[] = 'Пароль не должен быть короче 10-ти символов;';
                }

                if ($name == '') {
                    $errors[] = 'Введите имя пользователя;';
                }

                if ($surname == '') {
                    $errors[] = 'Введите фамилию пользователя;';
                }

                if (!User::checkEmail($email)) {
                    $errors[] = 'Неверный формат электронной почты;';
                }

                if (User::checkLoginExists($login)) {
                    $errors[] = 'Этот логин уже используется';
                }

                if ($errors) {
                    echo json_encode($errors);
                    return true;
                }

                if (User::addNewUserData($login, $password, $role, $name, $surname, $email)) {
                    echo 'saved';
                    return true;
                } else {
                    $errors[] = 'Внутренняя ошибка сервера. Пользоватль не был сохранен!';
                    echo json_encode($errors);
                }
                return true;
            }

            include_once MTN_ROOT . MTN_ADMIN . TEMPLATES_PATH . '/userManageTemplates/addUserTemplate.php';
        } else {
            header('Location: /mtn-admin/login');
        }

        return true;
    }
}