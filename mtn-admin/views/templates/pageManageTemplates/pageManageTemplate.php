<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 13.05.17
 * Time: 15:28
 */

$title = "Страницы";
include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/header.php' ?>

<div class="ui grid">
    <div class="three wide column">
        <? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/sideMenu.php'; ?>
    </div>
    <div class="thirteen wide column">
        <div class="admin content">
            <h1>Страницы сайта <? echo SITE_NAME; ?></h1>
            <div class="ui grid">
                <div class="eleven wide column">
                    <a class="ui left button blue labeled icon" href="/mtn-admin/pages/add"><i
                            class="add user icon"></i>Добавить страницы</a>
                </div>
                <div class="five wide column">
                    <form method="post" id="searchForm">
                        <div class="ui action input fluid">
                            <input type="text" placeholder="Поиск страниц..." name="searchField"
                                   id="searchField">
                            <button class="ui icon blue button" type="submit">
                                <i class="search icon"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="ui compact celled definition table" id="pagesTable">
                <thead class="full-width center aligned">
                <tr>
                    <th>id</th>
                    <th>Заголовок</th>
                    <th>Описание</th>
                    <th>Автор</th>
                    <th>Дата добавления</th>
                    <th>Последние изменение</th>
                    <th>Шаблон</th>
                    <th>Статус</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="pagesList" class="center aligned">
                <? foreach ($pages as $page): ?>
                    <tr class="pageId-<? echo $page['page_id'] ?>">
                        <td class="collapsing pageId"><? echo $page['page_id'] ?></td>
                        <td class="pageHeader"><a href="<? echo $page['page_route'] ?>"><? echo $page['page_title'] ?></a></td>
                        <td><? echo $page['page_description'] ?></td>
                        <td><? echo User::getUsernameById($page['page_added_by']); ?> </td>
                        <td><? echo $page['page_create_date'] ?></td>
                        <td><? echo $page['page_modify_date'] ?></td>
                        <td><? echo $page['page_template'] ?></td>
                        <td class="collapsing"
                        <? if ($page['page_status'] == 'published'): ?>
                            data-tooltip="Опубликовано" data-position="bottom center"> <i class="large green checkmark icon"></i>
                        <? elseif ($page['page_status'] == 'draft'): ?>
                            data-tooltip="Черновик" data-position="bottom center"> <i class="large orange write icon"></i>
                        <? elseif ($page['page_status'] == 'blocked'): ?>
                            data-tooltip="Заблокировано" data-position="bottom center">  <i class="large red lock icon"></i>
                        <? endif; ?>
                        </td>
                        <td class="collapsing right floated ">
                            <a class="ui primary icon button"
                               href="/mtn-admin/pages/edit/id<? echo $page['page_id'] ?>">
                                <i class="edit icon"></i>
                            </a>
                            <a class="ui red icon button deletePage">
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
        Удаление страницы
    </div>
    <div class="content">
        <p class="center align">Вы, действительно, хотите удалить эту страницу <span class="delPageHeader red"></span>?
        </p>
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
