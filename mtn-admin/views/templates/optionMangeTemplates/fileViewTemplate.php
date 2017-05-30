<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 29.05.17
 * Time: 14:00
 */

include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/header.php' ?>

<div class="ui grid">
    <div class="three wide column">
        <? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/sideMenu.php'; ?>
    </div>
    <div class="thirteen wide column">
        <div class="admin content">
            <h1><? echo $title ?> сайта <? echo SITE_NAME; ?></h1>
            <div class="ui grid">
                <div class="eleven wide column">
                    <a class="ui left button blue labeled icon" href="/mtn-admin/files/add/<?echo $section;?>"><i
                            class="add user icon"></i>Добавить файл</a>
                </div>
            </div>

            <table class="ui compact celled definition table" id="pagesTable">
                <thead class="full-width center aligned">
                <tr>
                    <th>Название файла</th>
                    <th>Путь к файлу</th>
                    <th>Дата создания</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="filesList" class="center aligned">
                <? foreach ($filesList as $file): ?>
                    <tr class="file" data-path="<? echo $file['file_path'] ?>">
                        <td class="filename"><? echo $file['file_name'] ?></td>
                        <td><? echo $file['file_path'] ?></td>
                        <td><? echo $file['file_date'] ?></td>
                        <td class="collapsing right floated ">
                            <a class="ui primary icon button"
                            href="edit/<?echo $section;?>/<?echo $file['file_name'];?>">
                                <i class="edit icon"></i>
                            </a>
                            <a class="ui red icon button deleteFile">
                                <i class="trash icon"></i>
                            </a>
                        </td>
                    </tr>
                <? endforeach; ?>
                </tbody>
            </table>
                        <? if (!$filesList): ?>
                            <h3>Нет файлов</h3>
                        <? endif; ?>
        </div>
    </div>
</div>
<div class="ui basic delete modal">
    <div class="ui icon header">
        <i class="trash icon"></i>
        Удаление файла
    </div>
    <div class="content">
        <p class="center align">Вы, действительно, хотите удалить файл <span class="delFileName red"></span>?
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
