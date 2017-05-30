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
    <?Essentials::mtn_head($title);?>
</head>
<body>
<?if($isAdmin):?>
    <div class="ui large menu no margin">
        <a class="active item" href="/mtn-admin/">Административная панель</a>
        <div class="right menu">
            <div class="ui simple dropdown item">
                <i class="icon large user"></i>
                <?echo $username;?> <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="/logout"><i class="icon sign out"></i>Выйти</a>
                </div>
            </div>
        </div>
    </div>

<?endif;?>
