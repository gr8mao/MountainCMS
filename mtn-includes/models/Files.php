<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 29.05.17
 * Time: 13:11
 */
class Files
{
    public static function getFilesListInDirectory($dir)
    {
        $filesList = [];

        $filesInDir = array_diff(scandir(MTN_ROOT . CUSTOM_PATH . $dir, 1),array('.','..'));

        foreach ($filesInDir as $file) {
            $filesList[] = array(
                'file_name' => stristr($file, '.', true),
                'file_path' => CUSTOM_PATH . $dir . $file,
                'file_full_path' => MTN_ROOT . CUSTOM_PATH . $dir . $file,
                'file_date' => date (DATE_FORMAT . ' ' . TIME_FORMAT, filemtime(MTN_ROOT . CUSTOM_PATH . $dir . $file))
            );
        }

        return $filesList;
    }
}