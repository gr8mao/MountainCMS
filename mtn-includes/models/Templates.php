<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 13.05.17
 * Time: 23:43
 */
class Templates
{
    public static function getTemplatesList()
    {
        $templatesList = [];

        $templates = array_diff(scandir(MTN_ROOT . MTN_CORE . TEMPLATES_PATH, 1),array('.','..'));

        foreach ($templates as $template) {
            if (strpos($template, 'Template.php') !== false) {
                $templatesList[] = str_replace('Template.php', '', $template);
            }
        }

        return $templatesList;
    }

    public static function getTemplatesFullList()
    {
        $filesList = [];

        $filesInDir = array_diff(scandir(MTN_ROOT . MTN_CORE . TEMPLATES_PATH, 1),array('.','..'));

        foreach ($filesInDir as $file) {
            $filesList[] = array(
                'file_name' => stristr($file, '.', true),
                'file_path' => TEMPLATES_PATH.'/' . $file,
                'file_full_path' => MTN_ROOT . MTN_CORE . TEMPLATES_PATH.'/' . $file,
                'file_date' => date (DATE_FORMAT . ' ' . TIME_FORMAT, filemtime(MTN_ROOT . MTN_CORE . TEMPLATES_PATH.'/' . $file))
            );
        }

        return $filesList;
    }
}