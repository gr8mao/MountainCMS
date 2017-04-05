<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 16.03.17
 * Time: 16:43
 */
class UserController
{
    public static function actionLogin()
    {
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $username = $_POST['username'];
            $password = $_POST['password'];
            // Флаг ошибок
            $errors = false;
            // Валидация полей
            if (!User::checkLogin($username)) {
                $errors[] = 'Логин не может быть короче 4-х символов';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 10-ти символов';
            }
            // Проверяем существует ли пользователь
            if(!$errors){
                $userId = User::checkUserData($username, $password);
                if (!$userId) {
                    // Если данные неправильные - показываем ошибку
                    $errors[] = 'Неверная пара логин и пароль!';
                } else {
                    // Если данные правильные, запоминаем пользователя (сессия)
                    $id = User::auth($userId);
                    if(User::checkUserAdmin($id)){
                        header('Location: /mtn-admin');
                        return true;
                    }
                    header('Location: /');
                    return true;
                }
            }
        }

        if(User::checkLogged()){
            header('Location: /');
            return true;
        }

        include_once MTN_ROOT.MTN_CORE.TEMPLATES_PATH.'/loginTemplate.php';
        return true;
    }

    public static function actionLogout()
    {
        if(!User::checkLogged()){
            header('Location: /login');
            return true;
        } else {
            User::logout();
            header('Location: /');
            return true;
        }
    }
}