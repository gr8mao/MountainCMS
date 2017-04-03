<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 01.04.17
 * Time: 11:49
 */
$title = "Пользователи";
include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/header.php' ?>

<div class="ui grid">
    <div class="three wide column">
        <div class="ui simple vertical tabular menu fluid admin">
            <a class="item" href="/mtn-admin">
                Страницы
            </a>
            <a class="item active" href="/mtn-admin/users">
                Пользователи
            </a>
            <a class="item">
                Настройки
            </a>
        </div>
    </div>
    <div class="thirteen wide column">
        <div class="admin content">
            <h1>Пользователи на сайте <? echo SITE_NAME; ?></h1>
            <div class="ui grid">
                <div class="eleven wide column">
                    <a class="ui left attached button blue labeled icon" href="/mtn-admin/users/addnew"><i class="add user icon"></i>Добавить пользователя</a>
                    <button class="right attached ui button blue right labeled icon"><i class="sitemap icon"></i>Изменить права</button>
                </div>
                <div class="five wide column">
                    <div class="ui action input fluid">
                        <input type="text" placeholder="Поиск пользователей...">
                        <button class="ui icon blue button">
                            <i class="search icon"></i>
                        </button>
                    </div>
                </div>
            </div>
            <table class="ui compact celled definition table">
                <thead class="full-width">
                <tr>
                    <th></th>
                    <th>id</th>
                    <th>Логин</th>
                    <th>Имя</th>
                    <th>Электронная почта</th>
                    <th>Права</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?foreach ($users as $user):?>
                    <tr>
                        <td class="collapsing">
                            <div class="ui checkbox">
                                <input type="checkbox"> <label></label>
                            </div>
                        </td>
                        <td><?echo $user['user_id']?></td>
                        <td><?echo $user['user_login']?></td>
                        <td><?echo $user['user_name'].' '.$user['user_surname'];?> </td>
                        <td><?echo $user['user_email']?></td>
                        <td><?echo $user['user_role']?></td>
                        <td class="collapsing">
                            <div class="ui right floated small primary labeled icon button">
                                <i class="user icon"></i> Изменить
                            </div>
                        </td>
                    </tr>
                <?endforeach;?>
                </tbody>
            </table>
            <?if($pagination):?>
                <?echo $pagination->get();?>
            <?endif;?>
        </div>
    </div>
</div>

<? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/footer.php' ?>
