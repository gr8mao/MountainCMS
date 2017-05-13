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
        <?include_once MTN_ROOT.MTN_ADMIN.'/views/layouts/sideMenu.php';?>
    </div>
    <div class="thirteen wide column">
        <div class="admin content">
            <h1>Пользователи на сайте <? echo SITE_NAME; ?></h1>
            <div class="ui grid">
                <div class="eleven wide column">
                    <a class="ui left button blue labeled icon" href="/mtn-admin/users/addnew"><i
                            class="add user icon"></i>Добавить пользователя</a>
                </div>
                <div class="five wide column">
                    <form method="post" id="searchForm">
                        <div class="ui action input fluid">
                            <input type="text" placeholder="Поиск пользователей..." name="searchField"
                                   id="searchField">
                            <button class="ui icon blue button" type="submit">
                                <i class="search icon"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="ui compact celled definition table" id="userTable">
                <thead class="full-width center aligned">
                <tr>
                    <th>id</th>
                    <th>Логин</th>
                    <th>Имя</th>
                    <th>Электронная почта</th>
                    <th>Права</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="usersList" class="center aligned">
                <? foreach ($users as $user): ?>
                    <tr class="userId-<? echo $user['user_id'] ?>">
                        <td class="collapsing userId"><? echo $user['user_id'] ?></td>
                        <td class="collapsing userLogin"><? echo $user['user_login'] ?></td>
                        <td><? echo $user['user_name'] . ' ' . $user['user_surname']; ?> </td>
                        <td><? echo $user['user_email'] ?></td>
                        <td><? echo $user['user_role'] ?></td>
                        <td class="collapsing right floated ">
                            <a class="ui primary icon button"
                               href="/mtn-admin/users/edit/id<? echo $user['user_id'] ?>">
                                <i class="edit icon"></i>
                            </a>
                            <a class="ui red icon button deleteUser">
                                <i class="trash icon"></i>
                            </a>
                        </td>
                    </tr>
                <? endforeach; ?>
                </tbody>
            </table>
            <? if ($pagination): ?>
                <? echo $pagination->get(); ?>
            <? endif; ?>
        </div>
    </div>
</div>
<div class="ui basic delete modal">
    <div class="ui icon header">
        <i class="trash icon"></i>
        Удаление пользователя
    </div>
    <div class="content">
        <p class="center align">Вы, действительно, хотите удалить этого пользователя <span class="delUserLogin red"></span>?</p>
    </div>
    <div class="actions">
        <div class="ui basic cancel inverted button">
            <i class="remove icon"></i>
            Отмена
        </div>
        <div class="ui red ok inverted button">
            <i class="checkmark icon"></i>
            Удалить
        </div>
    </div>
</div>

<? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/footer.php' ?>
