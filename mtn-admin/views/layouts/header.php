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
    <title><? echo $title ?> | <?echo SITE_NAME;?></title>
    <link href="<? echo SITE_URL . ASSETS_PATH . '/semantic-ui/semantic.min.css' ?>" rel="stylesheet" media="all" type="text/css">
    <link href="<? echo SITE_URL . ASSETS_PATH . '/css/admin.style.css' ?>" rel="stylesheet" media="all" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="ui large menu">
    <a class="active item" href="/">На сайт</a>
    <div class="right menu">
        <div class="ui simple dropdown item">
            <i class="icon large user"></i>
            <?echo $username;?> <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item"><i class="icon configure"></i>Редактировать</a>
                <a class="item" href="/logout"><i class="icon sign out"></i>Выйти</a>
            </div>
        </div>
    </div>
</div>


