<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 11.05.17
 * Time: 16:46
 */

$currentUri = $_SERVER['REQUEST_URI'];
?>

<div class="ui vertical accordion menu">
    <div class="item">
        <a class="title active" href="/mtn-admin">
            Панель администратора
        </a>
    </div>
    <div class="item">
        <a class="<?if(stristr($currentUri,'/mtn-admin/pages')){echo 'active';}?> title active" >
            <i class="dropdown icon"></i>
            Страницы
        </a>
        <div class="<?if(stristr($currentUri,'/mtn-admin/pages') or stristr($currentUri,'/mtn-admin/templates')){echo 'active';}?> content active">
            <div class="menu">
                <a class="item" href="/mtn-admin/pages">Все страницы</a>
                <a class="item" href="/mtn-admin/pages/add">Добавить страницу</a>
            </div>
        </div>
    </div>
    <div class="item">
        <a class="<?if(stristr($currentUri,'/mtn-admin/users')){echo 'active';}?> title active" >
            <i class="dropdown icon"></i>
            Пользователи
        </a>
        <div class="<?if(stristr($currentUri,'/mtn-admin/users')){echo 'active';}?> content active">
            <div class="menu">
                <a class="item" href="/mtn-admin/users">Все пользователи</a>
                <a class="item" href="/mtn-admin/users/addnew">Добавить пользователя</a>
            </div>
        </div>
    </div>
    <div class="item">
        <a class="<?if(stristr($currentUri,'/mtn-admin/options' or stristr($currentUri,'/mtn-admin/files'))){echo 'active';}?> title active" >
            <i class="dropdown icon"></i>
            Файловый менеджер
        </a>
        <div class="<?if(stristr($currentUri,'/mtn-admin/options') or stristr($currentUri,'/mtn-admin/files')){echo 'active';}?> content active">
            <div class="menu">
                <a class="item" href="/mtn-admin/templates">Шаблоны</a>
                <a class="item" href="/mtn-admin/files/styles">Стили</a>
                <a class="item" href="/mtn-admin/files/scripts">Скрипты</a>
                <a class="item" href="/mtn-admin/files/images">Фотогалерея</a>
            </div>
        </div>
    </div>
    <div class="item">
        <a class="title active" href="/mtn-admin/options">
            Настройки
        </a>
    </div>
</div>