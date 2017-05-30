<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 30.05.17
 * Time: 15:06
 */

$title = "Редактировать файл ".$fileInfo['basename'];
include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/header.php' ?>

<div class="ui grid">
    <div class="three wide column">
        <? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/sideMenu.php'; ?>
    </div>
    <div class="thirteen wide column">
        <div class="admin content">
            <form class="ui form" id="editFile" method="post">
                <h1>Редактировать файл <? echo $fileInfo['basename']; ?></h1>
                <div class="ui grid">
                    <div class="twelve wide column">
                        <input name="formId" value="editFile" hidden>
                        <div class="field">
                            <label for="file_contents">Содержание файла</label>
                            <textarea id="file_contents" name="file_contents"
                                      style="min-height: 500px; resize: none;"><? echo $fileContents; ?></textarea>
                        </div>
                    </div>
                    <div class="four wide column">
                        <div class="ui piled segment">
                            <h4 class="ui header">Информация о файле</h4>
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
                                        <? echo $fileDate; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="ui image header">
                                            <div class="content">
                                                Расширение
                                            </div>
                                        </h4>
                                    </td>
                                    <td>
                                        <? echo $fileInfo['extension']; ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <input type="submit" name="submit" class="ui blue button" value="Сохранить">
                            <a class="ui button" href="/mtn-admin/files/<?echo $section?>">Отмена</a>
                        </div>
                        <div class="ui piled segment error message<?if($errors):?> display block<?endif;?>">
                            <div class="ui bulleted list ">
                                <?if($errors):?>
                                    <?foreach($errors as $error):?>
                                        <div class="item"><?echo $error;?></div>
                                    <?endforeach;?>
                                <?endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/footer.php' ?>
