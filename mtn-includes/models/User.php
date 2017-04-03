<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 15.03.17
 * Time: 13:15
 */

class User
{
    public static function login()
    {
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $username = $_POST['username'];
            $password = $_POST['password'];
            // Флаг ошибок
            $errors = false;
            // Валидация полей
            if (!User::checkUsername($username)) {
                $errors[] = 'Логин не может быть короче 4-х символов';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            // Проверяем существует ли пользователь
            if(!$errors){
                $userId = User::checkUserData($username, $password);
                if (!$userId) {
                    // Если данные неправильные - показываем ошибку
                    $errors[] = 'Неверная пара логина и пароля!';
                    return $errors;
                } else {
                    // Если данные правильные, запоминаем пользователя (сессия)
                    User::auth($userId);
                }
            } else {
                return $errors;
            }
        }
        return false;
    }

    public static function logout()
    {
        setcookie('User',null, -1);
        if(isset($_COOKIE['User'])){
            return false;
        }
        return true;
    }

    /*
     * Функция шифрования ID пользователя
     */
    private static function encryptUserID($id){
        return openssl_encrypt($id,'RC4',SECURITY_KEY, OPENSSL_RAW_DATA);
    }

    /*
    * Функция дешифрования ID пользователя
    */
    private static function decryptUserID($id){
        return openssl_decrypt($id,'RC4',SECURITY_KEY, OPENSSL_RAW_DATA);
    }

    /*
     * Функция авторизации пользователя в системе
     *
     * Создание cookie с зашифрованным ID
     */
    public static function auth($userId)
    {
        $id = self::encryptUserID($userId);
        setcookie('User',$id, time()+18000);
        return $id;
    }

    /*
     * Функция хешировния пароля пользователя
     */
    private function encryptPassword($password)
    {
        return password_hash($password,PASSWORD_BCRYPT);
    }

    /*
     * Функция подтверждения правильности введенного пароля по хешу
     */
    private static function passwordVerify($password,$passwordHash)
    {
        return password_verify($password, $passwordHash);
    }

    /**
     * Возвращает информацию о пользователе в системе по id
     * @param string $id - hash id пользователя в системе
     * @return array user info
     */
    public static function getUserById($id)
    {
        $id = self::decryptUserID($id);
        // Соединение с БД
        $DBConnection = Database::getDBConnection();
        // Текст запроса к БД
        $query = 'SELECT * FROM mtn_users WHERE user_id = :id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $query = $DBConnection->prepare($query);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetch();
    }

    /**
     * Возвращает имя пользователя в системе по id
     * @param string $id - hash id пользователя в системе
     * @return string username
     */
    public static function getUsernameById($id)
    {
        $id = self::decryptUserID($id);
        // Соединение с БД
        $DBConnection = Database::getDBConnection();
        // Текст запроса к БД
        $query = 'SELECT user_login FROM mtn_users WHERE user_id = :id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $query = $DBConnection->prepare($query);
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $query->execute();
        $result = $query->fetch();
        return $result['user_login'];
    }

    /**
     * Проверяет является ли пользователь гостем
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function isGuest()
    {
        if (isset($_COOKIE['User'])) {
            return false;
        }
        return true;
    }

    /**
     * Проверяет совпадает ли пара username password введенными пользователем
     * @param string $username
     * @param string $password
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkUserData($username, $password)
    {
        // Соединение с БД
        $DBConnection = Database::getDBConnection();
        // Текст запроса к БД
        $query = 'SELECT user_id, user_password FROM mtn_users WHERE user_login = :login';
        // Получение результатов. Используется подготовленный запрос
        $query = $DBConnection->prepare($query);
        $query->bindParam(':login', $username, PDO::PARAM_STR);
        $query->execute();
        // Обращаемся к записи
        $result = $query->fetch();

        if($result and self::passwordVerify($password,$result['user_password'])){
            return $result['user_id'];
        } else {
            // TODO: Make ErrorController callback. Error: 'Wrong password'
        }

        // TODO: Make ErrorController callback. Error: 'No such user'
        return false;
    }

    /**
     * Проверяет не занят ли username другим пользователем
     * @param string $username <p>Username</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkUsernameExists($username)
    {
        // Соединение с БД
        $db = Database::getDBConnection();
        // Текст запроса к БД
        $query = 'SELECT COUNT(*) FROM mtn_users WHERE user_login = :login';
        // Получение результатов. Используется подготовленный запрос
        $query = $db->prepare($query);
        $query->bindParam(':login', $username, PDO::PARAM_STR);
        $query->execute();
        if ($query->fetchColumn()){
            return true;
        }
        return false;
    }

    /**
     * Проверяет пароль: не меньше, чем 6 символов
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет email
     * @param string $email <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет username
     * @param string $email <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkUsername($username)
    {
        if (strlen($username) >= 4) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет авторизирован ли в системе пользователь
     * @param void
     * @return boolean
     * @return string
     */
    public static function checkLogged()
    {
        if (isset($_COOKIE['User'])) {
            return $_COOKIE['User'];
        }
        return false;
    }

    public static function checkUserAdmin($userId)
    {
        $dbConnection = Database::getDBConnection();

        $query = 'SELECT user_role FROM mtn_users WHERE user_id = :user_id';

        $userId = self::decryptUserID($userId);
        $query = $dbConnection->prepare($query);
        $query->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch();

        if ($result['user_role'] <= 3){
            return true;
        }

        return false;
    }

    public static function getUsers($page,$perPage = 5){
        $dbConnection = Database::getDBConnection();

        $query = "SELECT * FROM mtn_users AS u LEFT JOIN mtn_userroles AS r ON (u.user_role = r.role_id) ORDER BY u.user_id ASC LIMIT :perPage OFFSET :page";

        $perPage = intval($perPage);
        $page = (intval($page) - 1) * $perPage;

        $query = $dbConnection->prepare($query);
        $query->bindParam(':page', $page, PDO::PARAM_INT);
        $query->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $query->execute();

        $query->setFetchMode(PDO::FETCH_ASSOC);

        $usersList = array();
        $i = 0;

        while($row = $query->fetch()) {
            $usersList[$i]['user_id'] = $row['user_id'];
            $usersList[$i]['user_login'] = $row['user_login'];
            $usersList[$i]['user_name'] = $row['user_name'];
            $usersList[$i]['user_surname'] = $row['user_surname'];
            $usersList[$i]['user_email'] = $row['user_email'];
//            $usersList[$i]['user_role'] = $row['user_role'];
            $usersList[$i]['user_role'] = $row['role_name'];
            $i++;
        }

        return $usersList;
    }

    public static function getUserCount()
    {
        $dbConnection = Database::getDBConnection();

        $query = 'SELECT COUNT(*) as count FROM mtn_users';

        $query = $dbConnection->prepare($query);
        $query->execute();

        $result = $query->fetch();
        return $result['count'];
    }

    public static function getUserRoles(){
        $dbConnection = Database::getDBConnection();

        $query = 'SELECT * as roles FROM mtn_userroles';

        $query = $dbConnection->prepare($query);
        $query->execute();

        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetch();
        return $result['roles'];
    }
}