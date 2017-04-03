<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 07.02.17
 * Time: 18:21
 */
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?echo $title;?></title>
    <link href="<? echo SITE_URL . ASSETS_PATH . '/semantic-ui/semantic.min.css' ?>" rel="stylesheet" media="all" type="text/css">
    <link href="<? echo SITE_URL . ASSETS_PATH . '/css/admin.style.css' ?>" rel="stylesheet" media="all" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="pushable">
<?if($isAdmin):?>
    <div class="ui large menu no margin">
        <a class="active item" href="/mtn-admin/">Административная панель</a>
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

<?endif;?>
