<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 13.05.17
 * Time: 19:21
 */

$title = "Новая страница";
include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/header.php' ?>

<div class="ui grid">
    <div class="three wide column">
        <? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/sideMenu.php'; ?>
    </div>
    <div class="thirteen wide column">
        <div class="admin content">
            <h1>Новая страница</h1>
            <form class="ui form" id="addPage" method="post">
                <div class="ui grid">
                    <div class="twelve wide column">
                        <input name="formId" value="newUserForm" hidden>
                        <div class="field">
                            <label for="page_title">Заголовок</label>
                            <input type="text" name="page_title" id='page_title' placeholder="Заголовок">
                        </div>
                        <div class="field inline">
                            <label for="page_route">Постоянная ссылка: </label>
                            <? echo substr(SITE_URL, 0, -1);?>
                            <input type="text"
                                   name="page_route"
                                   id='page_route'
                                   placeholder="Постоянная ссылка">
                        </div>
                        <div class="field">
                            <label for="page_contents">Содержание страницы</label>
                            <textarea id="page_contents" name="page_contents"
                                      style="min-height: 1000px; resize: none;"></textarea>
                        </div>
                        <h4 class="ui dividing header">Дополнительная информация</h4>
                        <div class="field">
                            <label for="page_description">Описание страницы</label>
                            <textarea id="page_description" name="page_description" rows="3" style="resize: none;"
                                      placeholder="Описание страницы"></textarea>
                        </div>
                        <div class="field">
                            <label for="page_keywords">Ключевые слова</label>
                            <input type="text" name="page_keywords" id='page_keywords' placeholder="Ключевые слова">
                        </div>
                    </div>
                    <div class="four wide column">
                        <div class="ui piled segment error message<? if ($errors): ?> display block<? endif; ?>">
                            <div class="ui bulleted list ">
                                <? if ($errors): ?>
                                    <? foreach ($errors as $error): ?>
                                        <div class="item"><? echo $error; ?></div>
                                    <? endforeach; ?>
                                <? endif; ?>
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
                                            <option value="published">Опубликовано</option>
                                            <option value="draft">Черновик</option>
                                            <option value="blocked">Заблокировано</option>
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
                                                    value="<? echo $template; ?>"><? echo $template; ?></option>
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
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/footer.php' ?>
