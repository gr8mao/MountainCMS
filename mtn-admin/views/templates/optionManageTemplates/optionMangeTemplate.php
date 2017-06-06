<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 11.05.17
 * Time: 16:50
 */

$title = "Настройки";
include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/header.php' ?>

<div class="ui grid">
    <div class="three wide column">
        <? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/sideMenu.php'; ?>
    </div>
    <div class="thirteen wide column">
        <div class="admin content">
            <h1>Настройки сайта <? echo SITE_NAME; ?></h1>
            <div class="ui grid">
                <div class="ten wide column">
                    <form class="ui form optionForm" id="optionForm" method="post">
                        <input name="formId" value="optionForm" hidden>
                        <? foreach ($optionsList as $option): ?>
                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="siteUrl"><? echo $option['option_description']; ?></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" class="option"
                                           placeholder="<? echo $option['option_description']; ?>"
                                           id="<? echo $option['option_name']; ?>"
                                           name="options[<? echo $option['option_name']; ?>]"
                                           value="<? echo $option['option_value']; ?>">
                                </div>
                            </div>
                        <? endforeach; ?>
                        <div class="right aligned column">
                            <input type="submit" name="submit" class="ui blue button" value="Сохранить">
                        </div>
                    </form>
                </div>
                <div class="six wide column">
                    <div class="ui message">
                        <div class="content">
                            <div class="header">
                                Немного информации для Вас
                            </div>
                            <div class="ui list infolist">
                                <div class="item SITE_NAME">
                                    <b>Название сайта</b> - отображение имени сайта на страницах.
                                </div>
                                <div class="item SITE_URL">
                                    <b>Адрес сайта</b> - настройка используется для корректного обращения к стилям,
                                    скриптам и медиафайлам со страниц сайта.
                                </div>
                                <div class="item SITE_DESCRIPTION">
                                    <b>Описание сайта</b> необходимо для SEO (поисковой оптимизации).
                                    Это описание будет отображаться в поисковых системах.
                                </div>
                                <div class="item SITE_KEYWORD">
                                    <b>Ключевые слова</b> необходимы для SEO (поисковой оптимизации).
                                    Поисковые системы будут оринетировать на эти слова при отборе страниц.
                                </div>
                                <div class="item ADMIN_EMAIL">
                                    <b>Электронная почта администратора</b> необходимо для обратной связи с
                                    пользователями сайтов.
                                </div>
                                <div class="item DATE_FORMAT TIME_FORMAT">
                                    <b>Формат даты и времени</b> необходим для настройки отображения времени и даты на
                                    сайте. Система поддерживает все форматы времени и даты, которые поддерживает язык
                                    PHP. Если вы не уверены, что верно изменяете формат, обратитесь к специалистам.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.option').focus(function () {
        var id = $(this).attr('id');

        $('.infolist').find('.bold').removeClass('bold');
        $('.infolist').find('.' + id).addClass('bold');
    });
</script>

<? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/footer.php' ?>
