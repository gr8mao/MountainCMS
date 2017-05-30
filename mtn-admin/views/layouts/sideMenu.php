<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 11.05.17
 * Time: 16:46
 */

$currentUri = $_SERVER['REQUEST_URI'];
?>

<div class="ui vertical accordion menu admin">
    <div class="item">
        <a class="<?if(stristr($currentUri,'/mtn-admin/pages')){echo 'active';}?> title" >
            <i class="dropdown icon"></i>
            Страницы
        </a>
        <div class="<?if(stristr($currentUri,'/mtn-admin/pages')){echo 'active';}?> content">
            <div class="menu">
                <a class="item" href="/mtn-admin/pages">Все страницы</a>
                <a class="item" href="/mtn-admin/templates">Шаблоны</a>
            </div>
        </div>
    </div>
    <div class="item">
        <a class="<?if(stristr($currentUri,'/mtn-admin/users')){echo 'active';}?> title" >
            <i class="dropdown icon"></i>
            Пользователи
        </a>
        <div class="<?if(stristr($currentUri,'/mtn-admin/users')){echo 'active';}?> content">
            <div class="menu">
                <a class="item" href="/mtn-admin/users">Все пользователи</a>
                <a class="item" href="/mtn-admin/users/addnew">Добавить пользователя</a>
            </div>
        </div>
    </div>
    <div class="item">
        <a class="<?if(stristr($currentUri,'/mtn-admin/options')){echo 'active';}?> title" >
            <i class="dropdown icon"></i>
            Настройки
        </a>
        <div class="<?if(stristr($currentUri,'/mtn-admin/options')){echo 'active';}?> content">
            <div class="menu">
                <a class="item" href="/mtn-admin/options">Общие настройки</a>
                <a class="item" href="/mtn-admin/files/styles">Стили</a>
                <a class="item" href="/mtn-admin/files/scripts">Скрипты</a>
            </div>
        </div>
    </div>
</div>