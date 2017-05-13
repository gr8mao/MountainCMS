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
        if(isset($_POST['submit'])){
            Options::updateSystemOptions($_POST['options']);
        }

        $optionsList = Options::getOptionsList();

        require_once MTN_ROOT.MTN_ADMIN.TEMPLATES_PATH.'/optionMangeTemplates/optionMangeTemplate.php';
        return true;
    }
}