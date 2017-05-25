<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 13.05.17
 * Time: 21:01
 */

$title = "Новая страница";
include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/header.php' ?>

<div class="ui grid">
    <div class="three wide column">
        <? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/sideMenu.php'; ?>
    </div>
    <div class="thirteen wide column">
        <div class="admin content">
            <form class="ui form" id="editPage" method="post">
                <h1>Редактировать страницу <u><? echo $pageInfo['page_title']; ?></u></h1>
                <div class="ui grid">
                    <div class="twelve wide column">
                        <input name="formId" value="newUserForm" hidden>
                        <div class="field">
                            <label for="page_title">Заголовок</label>
                            <input type="text" name="page_title" id='page_title' placeholder="Заголовок"
                                   value="<? echo $pageInfo['page_title']; ?>">
                        </div>
                        <div class="field inline">
                            <label for="page_route">Постоянная ссылка: </label>
                            <? echo substr(SITE_URL, 0, -1) . '<span class="page_route">' . $pageInfo['page_route'] . '</span>'; ?>
                            <input type="text"
                                   name="page_route"
                                   id='page_route'
                                   placeholder="Ссылка"
                                   hidden
                                   value="<? echo $pageInfo['page_route']; ?>"
                                   style="display: none;">
                            <a class="ui icon button right floated"
                               onclick="$('#page_route').show();$('span.page_route').hide();">
                                Изменить путь
                            </a>
                        </div>
                        <div class="field">
                            <label for="page_contents">Содержание страницы</label>
                            <textarea id="page_contents" name="page_contents"
                                      style="min-height: 1000px; resize: none;"><? echo $pageInfo['page_contents']; ?></textarea>
                        </div>
                        <h4 class="ui dividing header">Дополнительная информация</h4>
                        <div class="field">
                            <label for="page_description">Описание страницы</label>
                            <textarea id="page_description" name="page_description" rows="3" style="resize: none;"
                                      placeholder="Описание страницы"><? echo $pageInfo['page_description']; ?></textarea>
                        </div>
                        <div class="field">
                            <label for="page_keywords">Ключевые слова</label>
                            <input type="text" name="page_keywords" id='page_keywords' placeholder="Ключевые слова"
                                   value="<? echo $pageInfo['page_keywords']; ?>">
                        </div>
                    </div>
                    <div class="four wide column">
                        <? if (isset($warningMessage)): ?>
                            <div class="ui warning icon message visible">
                                <i class="icon info"></i>
                                <i class="close icon"></i>
                                <div class="content">
                                    <div class="header">
                                        <? echo $warningMessage; ?>
                                    </div>
                                    <div class="item"></div>

                                </div>
                            </div>
                        <? endif; ?>
                        <div class="ui piled segment error message<?if($errors):?> display block<?endif;?>">
                            <div class="ui bulleted list ">
                                <?if($errors):?>
                                    <?foreach($errors as $error):?>
                                        <div class="item"><?echo $error;?></div>
                                    <?endforeach;?>
                                <?endif;?>
                            </div>
                        </div>
                        <div class="ui piled segment">
                            <h4 class="ui header">Строка состояния</h4>
                            <table class="ui very basic collapsing celled table">
                                <tbody>
                                <tr>
                                    <td>
                                        <h4 class="ui image header">
                                            <div class="content">
                                                Статус
                                                <div class="sub header">страницы
                                                </div>
                                            </div>
                                        </h4>
                                    </td>
                                    <td>
                                        <select class="ui fluid dropdown selection" name="page_status" id="page_status">
                                            <option value="published" <?if($pageInfo['page_status'] == 'published'){ echo 'selected';}?>>Опубликовано</option>
                                            <option value="draft" <?if($pageInfo['page_status'] == 'draft'){ echo 'selected';}?>>Черновик</option>
                                            <option value="blocked" <?if($pageInfo['page_status'] == 'blocked'){ echo 'selected';}?>>Заблокировано</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="ui image header">
                                            <div class="content">
                                                Шаблон
                                                <div class="sub header">страницы
                                                </div>
                                            </div>
                                        </h4>
                                    </td>
                                    <td>
                                        <select class="ui fluid dropdown selection" name="page_template"
                                                id="page_template">
                                            <? foreach ($templatesList as $template): ?>
                                                <option
                                                    value="<? echo $template; ?>" <? if ($pageInfo['page_template'] == $template) {
                                                    echo 'selected';
                                                } ?>><? echo $template; ?></option>
                                            <? endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="right floated left aligned">
                                <a class="ui icon button " href="/mtn-admin/pages">
                                    <i class="trash icon"></i>
                                </a>
                                <input type="submit" name="submit" class="ui blue button" value="Сохранить">
                            </div>
                        </div>
                        <div class="ui piled segment">
                            <h4 class="ui header">Информация о странице</h4>
                            <table class="ui very basic collapsing celled table">
                                <tbody>
                                <tr>
                                    <td>
                                        <h4 class="ui image header">
                                            <div class="content">
                                                Добавлено
                                            </div>
                                        </h4>
                                    </td>
                                    <td>
                                        <? echo User::getUsernameById($pageInfo['page_added_by']); ?>,<br> <? echo $pageInfo['page_create_date']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="ui image header">
                                            <div class="content">
                                                Изменено
                                            </div>
                                        </h4>
                                    </td>
                                    <td>
                                        <? echo User::getUsernameById($pageInfo['page_lastModBy']); ?>,<br> <? echo $pageInfo['page_modify_date']; ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/footer.php' ?>
