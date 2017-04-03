<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.03.17
 * Time: 23:51
 */
$title = 'Панель администратора';
include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/header.php' ?>

<div class="ui grid">
    <div class="three wide column">
        <div class="ui simple vertical tabular menu fluid admin">
            <a class="item active" href="/mtn-admin">
                Страницы
            </a>
            <a class="item" href="/mtn-admin/users">
                Пользователи
            </a>
            <a class="item">
                Настройки
            </a>
        </div>
    </div>
    <div class="thirteen wide column">

    </div>
</div>

<? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/footer.php' ?>
