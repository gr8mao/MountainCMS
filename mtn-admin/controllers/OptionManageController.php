<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 11.05.17
 * Time: 16:51
 */

class OptionManageController
{
    public static function actionIndex()
    {
        if (isset($_POST['submit'])) {
            Options::updateSystemOptions($_POST['options']);
        }

        $optionsList = Options::getOptionsList();

        require_once MTN_ROOT . MTN_ADMIN . TEMPLATES_PATH . '/optionMangeTemplates/optionMangeTemplate.php';
        return true;
    }

    public static function actionFilesView($section)
    {
        switch ($section) {
            case 'scripts':
                $dir = '/js/';
                $title = 'Скрипты';
                break;
            case 'styles':
                $dir = '/css/';
                $title = 'Стили';
                break;
        }

        $filesList = Files::getFilesListInDirectory($dir);

        require_once MTN_ROOT . MTN_ADMIN . TEMPLATES_PATH . '/optionMangeTemplates/fileViewTemplate.php';
        return true;
    }

    public static function actionDeleteFile()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if (User::checkLogged() and User::checkUserAdmin($_COOKIE['User'])) {
                if (isset($_POST['opType']) and $_POST['opType'] == 'delete') {
                    $realPath = MTN_ROOT.$_POST['file_path'];
                    if (file_exists($realPath)) {
                        echo unlink($realPath);
                    }
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
            return true;
        }
        return true;
    }

    public static function actionEditFile($section, $file)
    {
        switch ($section) {
            case 'scripts':
                $dir = '/js/';
                $file = $file.'.js';
                $title = 'Изменения файла '. $file;
                break;
            case 'styles':
                $dir = '/css/';
                $file = $file.'.css';
                $title = 'Изменения файла '. $file;
                break;
        }

        $errors = [];

        if(isset($_POST['formId']) and $_POST['formId'] == 'editFile')
        {
            $fileContents = $_POST['file_contents'];

            file_put_contents(MTN_ROOT.CUSTOM_PATH.$dir.$file, $fileContents);

            header('Location: /mtn-admin/files/'.$section);
        }
        $fileInfo = pathinfo(MTN_ROOT.CUSTOM_PATH.$dir.$file);
        $fileDate = date (DATE_FORMAT . ' ' . TIME_FORMAT, filemtime(MTN_ROOT.CUSTOM_PATH.$dir.$file));
        $fileContents = file_get_contents(MTN_ROOT.CUSTOM_PATH.$dir.$file);

        require_once MTN_ROOT . MTN_ADMIN . TEMPLATES_PATH . '/optionMangeTemplates/fileEditTemplate.php';
        return true;
    }

    public static function actionAddFile($section)
    {
        switch ($section) {
            case 'scripts':
                $dir = '/js/';
                $ext = '.js';
                $mime = 'text/javascript';
                $title = 'Добавить скрипт';
                break;
            case 'styles':
                $dir = '/css/';
                $ext = '.css';
                $mime = 'text/css';
                $title = 'Добавить таблцу стилей';
                break;
        }

        $errors = [];
        $success = [];

        if(isset($_POST['formId']) and $_POST['formId'] == 'addFile')
        {
            $fileName = $_POST['file_name'];
            $fileContents = $_POST['file_contents'];

            if($fileName == '' and preg_match('/^[a-zA-Z0-9_]+$/',$fileName))
            {
                $errors[] = 'Введите корректное имя файла';
            }

            if(!$errors)
            {
                header('Content-Type: text/'.$mime);
                file_put_contents(MTN_ROOT.CUSTOM_PATH.$dir.$fileName.$ext, $fileContents);
                header('Location: /mtn-admin/files/'.$section);
            }
        }

        require_once MTN_ROOT . MTN_ADMIN . TEMPLATES_PATH . '/optionMangeTemplates/fileAddTemplate.php';
        return true;
    }
}