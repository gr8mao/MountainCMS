<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 31.05.17
 * Time: 18:07
 */
$title = 'Фотогалерея';

include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/header.php' ?>

<div class="ui grid">
    <div class="three wide column">
        <? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/sideMenu.php'; ?>
    </div>
    <div class="thirteen wide column">
        <div class="content">
            <h1><? echo $title ?> сайта <? echo SITE_NAME; ?></h1>
            <div class="ui grid">
                <div class="eleven wide column">
                    <a class="ui left button blue labeled icon uploadBtn"><i
                            class="add user icon"></i>Добавить файл</a>
                </div>
            </div>
            <div class="ui grid">
                <? foreach ($filesList as $file): ?>
                    <div class="four wide column">
                        <div class="ui card fluid" data-path="<? echo $file['file_path'] ?>">
                            <div class="image gallery-img centered preview"
                                 style="background: url('<? echo $file['file_path']; ?>'); background-size: cover;">
                            </div>
                            <div class="content">
                        <span class="right floated filename truncate" style="width: 180px;">
                          <? echo $file['file_name'] ?>
                        </span>
                                <span class="right floated meta"><? echo $file['file_date'] ?></span>
                                <a class="ui red icon button deleteFile">
                                    <i class="trash icon"></i>
                                </a>
                                <!--                                <a class="ui primary icon button"-->
                                <!--                                   href="edit/--><? // echo $section; ?><!--/-->
                                <? // echo $file['file_name']; ?><!--">-->
                                <!--                                    <i class="edit icon"></i>-->
                                <!--                                </a>-->
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
            <? if (!$filesList): ?>
                <h3>Нет файлов</h3>
            <? endif; ?>


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
        <div class="ui basic previewModal modal">
            <div class="header">Header</div>
            <div class="image content">
                <img class="image previewImg" src="">
                <div class="description">
                    <p></p>
                </div>
            </div>
        </div>
        <div class="ui basic download modal">
            <form method="post">
                <div id="dropZone">
                    Перетащите файл сюда
                </div>
            </form>
        </div>

        <script type="text/javascript">

            $('.uploadBtn').on("click", function () {
                var delFileName = $(this).parent().parent().find('.filename').text();
                var delFilePath = $(this).parent().data('path');
                $('.previewImg').attr('src',delFilePath);
                $('.previewModal .header').text(delFileName);
                $('.download.modal').modal({
                    onHide: function () {
                        var dropZone = $('#dropZone');
                        dropZone.text('Перетащите файл сюда');
                        dropZone.removeClass('error').removeClass('drop');
                    }
                }).modal('show');
                return false;
            });

            $(document).ready(function () {

                var dropZone = $('#dropZone'),
                    maxFileSize = 1000000; // максимальный размер фалйа - 1 мб.

                // Проверка поддержки браузером
                if (typeof(window.FileReader) == 'undefined') {
                    dropZone.text('Не поддерживается браузером!');
                    dropZone.addClass('error');
                }

                // Добавляем класс hover при наведении
                dropZone[0].ondragover = function () {
                    dropZone.addClass('hover');
                    return false;
                };

                // Убираем класс hover
                dropZone[0].ondragleave = function () {
                    dropZone.removeClass('hover');
                    return false;
                };

                // Обрабатываем событие Drop
                dropZone[0].ondrop = function (event) {
                    event.preventDefault();
                    dropZone.removeClass('hover');
                    dropZone.addClass('drop');

                    var file = event.dataTransfer.files[0];

                    // Проверяем размер файла
                    if (file.size > maxFileSize) {
                        dropZone.text('Файл слишком большой!');
                        dropZone.removeClass('drop').addClass('error');
                        return false;
                    }
                    // Создаем запрос


                    var fd = new FormData();
                    fd.append('file', file);

                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', uploadProgress, false);
                    xhr.onreadystatechange = stateChange;
                    xhr.open('POST', '/mtn-admin/files/images', true);

                    xhr.responseType = 'text';

                    xhr.onload = function () {
                        if (xhr.readyState === xhr.DONE) {
                            if (xhr.status === 200) {
                                if (xhr.response == 'exist') {
                                    dropZone.text('Файл с таким именем уже сущесвтует в системе!');
                                    dropZone.removeClass('drop').addClass('error');
                                } else if (xhr.response == 'wrongExt') {
                                    dropZone.text('Неверный формат файла. Доступны только png, jpg, jpeg и svg');
                                    dropZone.removeClass('drop').addClass('error');
                                } else if (xhr.response == 1) {
                                    dropZone.text('Загрузка успешно завершена!');
                                } else {
                                    dropZone.text('Файл не был перемещен, обратитесь к администратору!');
                                    dropZone.removeClass('drop').addClass('error');
                                }
//                                alert(xhr.response);
                            }
                        }
                    };

                    xhr.send(fd);
                };

                // Показываем процент загрузки
                function uploadProgress(event) {
                    var percent = parseInt(event.loaded / event.total * 100);
                    dropZone.text('Загрузка: ' + percent + '%');
                }

                // Пост обрабочик
                function stateChange(event) {
                    if (event.target.readyState == 4) {
                        if (event.target.status == 200) {
                            dropZone.text('Загрузка успешно завершена!');
                        } else {
                            dropZone.text('Произошла ошибка!');
                            dropZone.removeClass('drop').addClass('error');
                        }
                    }
                }

            });
        </script>
        <? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/footer.php' ?>
