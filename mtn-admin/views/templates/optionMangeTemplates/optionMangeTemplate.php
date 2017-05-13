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
                                    <label for="siteUrl"><?echo $option['option_description'];?></label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" placeholder="<?echo $option['option_description'];?>" id="<?echo $option['option_name'];?>" name="options[<?echo $option['option_name'];?>]"
                                           value="<?echo $option['option_value'];?>">
                                </div>
                            </div>
                        <? endforeach; ?>
                        <div class="right aligned column">
                            <input type="submit" name="submit" class="ui blue button" value="Сохранить">
                        </div>
                    </form>
                </div>
                <div class="six wide column">
                    <div class="ui warning icon message transition" id="warningPassword" style="display: none;">
                        <i class="icon warning"></i>
                        <i class="close icon"></i>
                        <div class="content">
                            <div class="header">
                                Внимание! Запишите пароль!
                            </div>
                            В целях безопасности пароль шифруется и в открытом виде в системе не показывается!
                        </div>
                    </div>
                    <div class="ui warning icon message" id="warningAdmin" style="display: none;">
                        <i class="icon warning"></i>
                        <i class="close icon"></i>
                        <div class="content">
                            <div class="header">
                                Внимание!
                            </div>
                            Назначая пользователя администратором, вы открываете ему полный функционал управления
                            системой.
                            Удостоверьтесь, что даете доступ к системе проверенным людям!
                        </div>
                    </div>
                    <div class="ui icon message" id="loading" style="display: none;">
                        <i class="notched circle loading icon"></i>
                        <div class="content">
                            <div class="header">
                                Секундочку!
                            </div>
                            <p>Сохраняем данные пользователя в системе</p>
                        </div>
                    </div>
                    <div class="ui bottom attached warning message errors " style="display: none;">
                        <h3>Мы нашли несколько ошибок!</h3>
                        <div class="ui bulleted list">

                        </div>
                    </div>
                    <div class="ui success icon message" id="successRegistr" style="display: none;">
                        <i class="icon checkmark"></i>
                        <i class="close icon"></i>
                        <div class="content">
                            <div class="header">
                                Данные пользователя изменены!
                            </div>
                            <p>Данные пользователя успешно изменены в системе</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/footer.php' ?>
