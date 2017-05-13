<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 11.05.17
 * Time: 16:46
 */

$currentUri = $_SERVER['REQUEST_URI'];
?>

<div class="ui secondary vertical menu fluid admin">
    <a class="item <?if(stristr($currentUri,'/mtn-admin/page')){ echo 'active';}?>" href="/mtn-admin/">
        Страницы
    </a>
    <a class="item <?if(stristr($currentUri,'/mtn-admin/users')){ echo 'active';}?>" href="/mtn-admin/users">
        Пользователи
    </a>
    <a class="item <?if(stristr($currentUri,'/mtn-admin/options')){ echo 'active';}?>" href="/mtn-admin/options">
        Настройки
    </a>
</div>
