<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 31.05.17
 * Time: 16:14
 */

?>

    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Авторизация на сайте</title>
        <link href="/mtn-includes/assets/framework/semantic.min.css" rel="stylesheet" media="all" type="text/css">
        <link href="/mtn-includes/assets/service/css/admin.style.css" rel="stylesheet" media="all" type="text/css">
    </head>
    <body>
    <div class="ui three column centered grid">
        <div class="column center aligned">
            <img class="ui image centered login logo" src="/mtn-includes/assets/service/images/mtn-logo.png">
        </div>
        <div class="two column centered row">
            <div class="column">
                <div class="ui segment">
                    <h2 class="ui icon center aligned header">
                        <div class="content">
                            Добро пожаловать в систему
                        </div>
                    </h2>
                    <p>Для того, чтобы продолжить инсталляцию, сообщите нам информацию для подключения базы данных.
                        Чтобы продолжить нам нужна следующая информация:</p>
                    <ul class="ui list">
                        <li>Адрес базы данных</li>
                        <li>Логин пользователя базы данных</li>
                        <li>Пароль пользователя базы данных</li>
                        <li>Имя базы данных</li>
                        <li>Префикс таблиц в базу данных</li>
                    </ul>
                    <p>Мы используем эту информацию для того чтобы заполнить файл <code>mtn-Config.php</code>,</p>
                </div>
            </div>
        </div>
    </div>
    </body>
    <script src="/mtn-includes/assets/framework/jquery-2.1.0.min.js" rel="script" type="text/javascript"></script>
    <script src="/mtn-includes/assets/framework/semantic.min.js'?>" rel="script" type="text/javascript"></script>
    <script src="/mtn-includes/assets/service/js/validator.js'?>" rel="script" type="text/javascript"></script>
    </html>


<? die(''); ?>