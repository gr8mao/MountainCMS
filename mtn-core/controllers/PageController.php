<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 31.01.17
 * Time: 1:36
 */


class PageController
{
    public function actionPage($pageRoute)
    {

        $page = new Page($pageRoute);

        if($page->getStatus() == 'published')
        {
            self::renderPage($page);
        } else {
            ErrorController::actionError404();
        }
        return true;
    }

    private function renderPage($page) : bool
    {
        $page->getHeader();
        $contents = $page->getContents();
        include_once $page->getTemplatePath();
        $page->getFooter();
        return true;
    }
}