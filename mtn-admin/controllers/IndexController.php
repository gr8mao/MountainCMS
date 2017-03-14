<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.03.17
 * Time: 23:50
 */
class IndexController
{
    public function actionIndex()
    {
        include_once ROOT.ADMIN_PATH.'/views/templates/index_template.php';
        return true;
    }
}