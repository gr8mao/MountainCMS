<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 30.05.17
 * Time: 15:59
 */
class Essentials
{
    public static function mtn_head($title)
    {
        echo '
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>' . $title . '</title>
        ' . self::getFrameworkFiles('styles') . PHP_EOL
            . self::getFilesList('/css/') . PHP_EOL;

        if(!User::isGuest() and User::checkUserAdmin($_COOKIE['User']))
        {
            echo self::getFilesList('/css/', true) . PHP_EOL;
        }
    }

    public static function mtn_admin_head($title)
    {
        echo '
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>' . $title . '</title>
        ' . self::getFrameworkFiles('styles') . PHP_EOL
            . self::getFilesList('/css/', true) . PHP_EOL;
    }

    public static function mtn_footer()
    {
        self::getFrameworkFiles('scripts');
        self::getFilesList('/js/');
    }

    public static function mtn_admin_footer()
    {
        self::getFrameworkFiles('scripts');
        self::getFilesList('/js/', true);
    }

    private static function getFilesList($dir, $isAdmin = false)
    {
        if ($isAdmin) {
            $dir = SERVICE_PATH . $dir;
        } else {
            $dir = CUSTOM_PATH . $dir;
        }
        $filesList = array_diff(scandir(MTN_ROOT . $dir, 1), array('.', '..'));
        $filesListRes = [];
        foreach ($filesList as $file) {
            $fileInfo = pathinfo(MTN_ROOT . $dir . $file);
            if ($fileInfo['extension'] == 'css') {
                echo '<link href="' . SITE_URL . $dir . $file . '" rel="stylesheet" media="all">' . PHP_EOL;
            } else if ($fileInfo['extension'] == 'js') {
                echo '<script src="' . SITE_URL . $dir . $file . '"type="text/javascript"></script>' . PHP_EOL;
            }
        }
    }

    private static function getFrameworkFiles($dir)
    {
        $filesList = [];

        $filesInDir = array_diff(scandir(MTN_ROOT . ASSETS_PATH . '/framework'), array('.', '..'));

        foreach ($filesInDir as $file) {
            $fileInfo = pathinfo(MTN_ROOT . ASSETS_PATH . '/framework/' . $file);
            if (!isset($fileInfo['extension'])) {
                continue;
            } else if ($fileInfo['extension'] == 'css' and $dir == 'styles') {
                echo '<link href="' . SITE_URL . ASSETS_PATH . '/framework/' . $file . '" rel="stylesheet" media="all" type="text/css">' . PHP_EOL;
            } else if ($fileInfo['extension'] == 'js' and $dir == 'scripts') {
                echo '<script src="' . SITE_URL . ASSETS_PATH . '/framework/' . $file . '"type="text/javascript"></script>' . PHP_EOL;
            }
        }
    }
}