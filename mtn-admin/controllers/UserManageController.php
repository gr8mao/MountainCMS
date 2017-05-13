<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 01.04.17
 * Time: 20:14
 */
class UserManageController
{
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

            if (isset($_POST['filter'])) {
                $count = User::getUserCount($_POST['filter']);

                $pagination = false;
                if ($count > 5) {
                    $pagination = new Pagination($count, $page, 5, 'page-');
                    $pagination = $pagination->get();
                }

                if ($page == '') {
                    $page = 1;
                }

                $users = User::getUsers($page, $_POST['filter']);
                $result = array_merge(['users' => $users], ['pagination' => $pagination]);

                echo json_encode($result);
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

    public static function actionEditUser($id)
    {
        if (User::checkLogged() and User::checkUserAdmin($_COOKIE['User'])) {
            $username = User::getUsernameById($_COOKIE['User']);
            $userroles = User::getUserRoles();
            $userInfo = User::getUserById($id);

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

                if ($password and !User::checkPassword($password)) {
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

                if ($errors) {
                    echo json_encode($errors);
                    return true;
                }

                if (User::editUserInfo($id, $login, $role, $name, $surname, $email, $password)) {
                    echo 'saved';
                    return true;
                } else {
                    $errors[] = 'Внутренняя ошибка сервера. Пользоватль не был сохранен!';
                    echo json_encode($errors);
                }
                return true;
            }

            include_once MTN_ROOT . MTN_ADMIN . TEMPLATES_PATH . '/userManageTemplates/userEditTemplates.php';
        } else {
            header('Location: /mtn-admin/login');
        }

        return true;
    }

    public static function actionDeleteUser($userid)
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if (User::checkLogged() and User::checkUserAdmin($_COOKIE['User'])) {
                $result = User::deleteUser($userid);
                if ($result == 1) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo false;
            }
            return true;
        }
    }
}