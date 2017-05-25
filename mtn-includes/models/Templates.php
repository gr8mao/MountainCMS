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

        $templates = scandir(MTN_ROOT . MTN_CORE . TEMPLATES_PATH, 1);

        foreach ($templates as $template) {
            if (strpos($template, 'Template.php') !== false) {
                $templatesList[] = str_replace('Template.php', '', $template);
            }
        }

        return $templatesList;
    }
}