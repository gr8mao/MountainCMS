<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.03.17
 * Time: 23:51
 */
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация на сайте <? echo SITE_NAME; ?></title>
    <link href="<? echo SITE_URL . ASSETS_PATH . '/semantic-ui/semantic.min.css' ?>" rel="stylesheet" media="all" type="text/css">
    <link href="<? echo SITE_URL . ASSETS_PATH . '/css/admin.style.css' ?>" rel="stylesheet" media="all" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="ui three column centered grid">
    <div class="column center aligned">
        <img class="ui image centered login logo" src="<?echo SITE_URL.ASSETS_PATH.'/images/mtn-logo.png'?>">
    </div>
    <div class="three column centered row">
        <div class="column">
            <div class="ui attached message">
                <div class="header">
                    Добро пожаловать на сайт!
                </div>
                <p>Введите данные аккаунта, чтобы авторизироваться в системе</p>
            </div>
            <form class="ui form attached fluid segment" id="loginForm" method="post">
                <div class="field">
                    <label for="username">Логин</label>
                    <input placeholder="Логин" type="text" name="username" id="username">
                </div>
                <div class="field">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" id="password" placeholder="Пароль">
                </div>
                <input class="ui blue submit button" name="submit" id="submit" value="Войти" type="submit">
            </form>
            <div class="ui bottom attached warning message errors <?if(!$errors):?>display none<?endif;?>">
                <h3>Мы нашли несколько ошибок!</h3>
                <div class="ui bulleted list">
                    <?if($errors):?>
                        <?foreach($errors as $error):?>
                            <div class="item"><?echo $error;?></div>
                        <?endforeach;?>
                    <?endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.0.min.js" rel="script" type="text/javascript"></script>
<script src="<?echo SITE_URL.ASSETS_PATH.'/semantic-ui/semantic.min.js'?>" rel="script" type="text/javascript"></script>
<script src="<?echo SITE_URL.ASSETS_PATH.'/js/validator.js'?>" rel="script" type="text/javascript"></script>
</html>