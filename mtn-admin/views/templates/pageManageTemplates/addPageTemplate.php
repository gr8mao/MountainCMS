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
                        <input name="formId" value="newPageForm" hidden>
                        <div class="field">
                            <label for="page_title">Заголовок</label>
                            <input type="text" name="page_title" id='page_title' placeholder="Заголовок">
                        </div>
                        <div class="field inline">
                            <label for="page_route">Постоянная ссылка: </label>
                            <? echo substr(SITE_URL, 0, -1); ?>
                            <input type="text"
                                   name="page_route"
                                   id='page_route'
                                   placeholder="Постоянная ссылка">
                        </div>
                        <div class="field">
                            <label for="page_contents">Содержание страницы</label>
                            <div class="ui icon buttons" style="padding: 5px 0;">
                                <a class="ui button tagBtn">div</a>
                                <a class="ui button tagBtn">p</a>
                                <a class="ui button tagBtn">a</a>
                                <a class="ui button tagBtn">span</a>
                                <a class="ui button tagBtn">h1</a>
                                <a class="ui button tagBtn">h2</a>
                                <a class="ui button tagBtn">h3</a>
                                <a class="ui button tagBtn">h4</a>
                                <a class="ui button tagBtn">h5</a>
                            </div>
                            <div class="ui icon buttons">
                                <a class="ui icon button right floated mediaBtn">
                                    Медиафайлы
                                </a>
                            </div>
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

<div class="ui modal media">
    <i class="close icon"></i>
    <div class="header">
        Медиафайлы
    </div>
    <div class="content mediaContent">

        <div class="ui grid centered link cards">
            <? if ($filesList): ?>
                <? foreach ($filesList as $file): ?>
                    <div class="five wide column mediaCard" data-path="<? echo $file['file_path']; ?>">
                        <div class="ui card fluid mediaCard" data-path="<? echo $file['file_path']; ?>">
                            <div class="image gallery-img centered"
                                 style="background: url('<? echo $file['file_path']; ?>'); background-size: cover;">
                            </div>
                            <div class="content">
                                <span class="right floated filename truncate"
                                      style="width: 180px;"><? echo $file['file_name'] ?></span>
                                <span class="right floated meta"><? echo $file['file_date'] ?></span>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            <? else: ?>
                <h2 class="centered">Нет файлов</h2>
            <? endif; ?>
        </div>

    </div>
    <div class="actions">
        <div class="ui form">
            <div class="ui action input fluid">
                <input type="text" id='imageTag' placeholder="Тег изображения">
                <button class="right ui button" id="copyBtn">Копировать</button>
            </div>
        </div>
    </div>
</div>

<script>
    var caret = 0;
    $('#page_contents').on("click", function () {
        var node = document.getElementById("page_contents");
        caret = getCaret(node);
        return false;
    }).on("change", function () {
        var node = document.getElementById("page_contents");
        caret = getCaret(node);
        return false;
    });

    String.prototype.splice = function (idx, rem, str) {
        return this.slice(0, idx) + str + this.slice(idx + Math.abs(rem));
    };

    $('.tagBtn').on('click', function () {
        var tagName = $(this).text();
        var pageContent = $('#page_contents').val();

        var tag = '';
        var closeTag = '';
        switch (tagName) {
            case 'a':
            {
                tag = '<a href="your_link">Link';
                closeTag = '</a>';
                break;
            }
            default:
            {
                tag = '<' + tagName + '>';
                closeTag = '</' + tagName + '>';
                break;
            }
        }


        var result = pageContent.splice(caret, 0, tag + closeTag);
        caret = getCaret(document.getElementById("page_contents")) + tag.length;

        $('#page_contents').val(result);

        setCaretToPos(document.getElementById("page_contents"), caret);
        document.getElementById("page_contents").focus();

        toastr.success('Тэг ' + tagName + ' добавлен на страницу!');

        return false;
    });


    $('.mediaBtn').on("click", function () {
        $('.media.modal').modal('show');
        return false;
    });

    $('.mediaCard').on("click", function () {
        var path = $(this).data('path');
        var pageContent = $('#page_contents').val();
        var imageTag = '<img src="' + path + '">';
        $('#imageTag').val(imageTag);
        var clipboard = new Clipboard('#copyBtn', {
            target: function () {
                return document.querySelector('#imageTag');
            }
        });

        var result = pageContent.splice(caret, 0, imageTag);
        caret = getCaret(document.getElementById("page_contents")) + imageTag.length;

        $('#page_contents').val(result);

        setCaretToPos(document.getElementById("page_contents"), caret);
        document.getElementById("page_contents").focus();

        $('.media.modal').modal('hide');
        toastr.success('Тег изображения всталвлен в код страницы!');
        return false;
    });

    $('#copyBtn').on('click', function () {
        toastr.info('Тег изображения скопирован! Вставьте его в код страницы.');
        $('.media.modal').modal('hide');
        return false;
    });

    function getCaret(node) {
        //node.focus();
        /* without node.focus() IE will returns -1 when focus is not on node */
        if (node.selectionStart) return node.selectionStart;
        else if (!document.selection) return 0;
        var c = "\001";
        var sel = document.selection.createRange();
        var dul = sel.duplicate();
        var len = 0;
        dul.moveToElementText(node);
        sel.text = c;
        len = (dul.text.indexOf(c));
        sel.moveStart('character', -1);
        sel.text = "";
        return len;
    }

    function setSelectionRange(input, selectionStart, selectionEnd) {
        if (input.setSelectionRange) {
            input.focus();
            input.setSelectionRange(selectionStart, selectionEnd);
        }
        else if (input.createTextRange) {
            var range = input.createTextRange();
            range.collapse(true);
            range.moveEnd('character', selectionEnd);
            range.moveStart('character', selectionStart);
            range.select();
        }
    }

    function setCaretToPos(input, pos) {
        setSelectionRange(input, pos, pos);
    }
</script>

<? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/footer.php' ?>
