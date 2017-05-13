<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 08.04.17
 * Time: 12:00
 */

$title = "Изменение пользователя";
include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/header.php' ?>

<div class="ui grid">
    <div class="three wide column">
        <?include_once MTN_ROOT.MTN_ADMIN.'/views/layouts/sideMenu.php';?>
    </div>
    <div class="thirteen wide column">
        <div class="admin content">
            <h1>Изменение информации о пользователе <?echo $userInfo['user_login']?></h1>
            <div class="ui grid">
                <div class="ten wide column">
                    <form class="ui form editForm" id="newUserForm" method="post">
                        <input name="formId" value="newUserForm" hidden>
                        <h4 class="ui dividing header">Информация об аккаунте</h4>
                        <div class="two fields">
                            <div class="field">
                                <label for="login">Логин</label>
                                <input type="text" name="login" id='login' placeholder="Логин" value="<?echo $userInfo['user_login']?>">
                            </div>
                            <div class="field">
                                <label for="password">Пароль</label>
                                <div class="ui action input">
                                    <input type="text" name="password" id="password" placeholder="Пароль">
                                    <button class="ui blue right icon button" id="generatePassword">
                                        <i class="wizard icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label for="user_role">Роль в системе</label>
                            <div class="fields">
                                <div class="eight wide field">
                                    <select class="ui fluid dropdown selection" name="userRole" id="userRole">
                                        <?foreach($userroles as $role):?>
                                            <option value='<?echo $role['role_id']?>' <?if($role['role_id'] === $userInfo['user_role']){ echo 'selected';}?> id="role_<?echo $role['role_id']?>"><?echo $role['role_name']?></option>
                                        <?endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h4 class="ui dividing header">Личная и контактная информация</h4>
                        <div class="field">
                            <label>Имя пользователя</label>
                            <div class="two fields">
                                <div class="field">
                                    <input type="text" name="name" id="firstName" placeholder="Имя" value="<?echo $userInfo['user_name']?>">
                                </div>
                                <div class="field">
                                    <input type="text" name="surname" id="secondName" placeholder="Фамилия" value="<?echo $userInfo['user_surname']?>">
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>E-mail</label>
                            <div class="fields">
                                <div class="eight wide field">
                                    <input type="text" name="email" id='email' placeholder="Электронная почта" value="<?echo $userInfo['user_email']?>">
                                </div>
                            </div>
                        </div>
                        <div class="right floated left aligned column">
                            <a class="ui left attached button" href="/mtn-admin/users">Отменить</a>
                            <input type="submit" name="submit" class="right attached ui blue button" value="Сохранить">
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
