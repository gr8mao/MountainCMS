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
    <?Essentials::mtn_admin_head($title);?>
    <link href="<? echo SITE_URL . ASSETS_PATH . '/service/css/admin.style.css' ?>" rel="stylesheet" media="all" type="text/css">
    <link href="<? echo SITE_URL . ASSETS_PATH . '/service/css/toastr.css' ?>" rel="stylesheet" media="all" type="text/css">
</head>
<body>
<div class="ui large menu">
    <a class="active item" href="/">На сайт</a>
    <div class="right menu">
        <div class="ui simple dropdown item">
            <i class="icon large user"></i>
            <?global $username; echo $username;?> <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="/mtn-admin/users/edit/id<?echo User::checkLogged();?>"><i class="icon configure"></i>Редактировать</a>
                <a class="item" href="/logout"><i class="icon sign out"></i>Выйти</a>
            </div>
        </div>
    </div>
</div>


