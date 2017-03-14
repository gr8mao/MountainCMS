<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.03.17
 * Time: 20:18
 */
class Page
{
    private $title;
    private $description;
    private $keywords;
    private $contents;
    private $template;
    private $route;

    public function __construct($route)
    {

        if ($route === '') {
            $this->route = '/';
        } else {
            $this->route = $route;
        }

        self::initPage();
    }

    private function initPage(){
        $pageConfig = self::getPageConfig();

        $this->contents = $pageConfig['Contents'];
        $this->title = $pageConfig['Title'];
        $this->description = $pageConfig['Description'];
        $this->keywords = $pageConfig['Keywords'];
        $this->template = $pageConfig['Template'];
    }

    private function getPageConfig()
    {
        $dbConnection = Database::getDBConnection();

        if($dbConnection) {
            $query = "SELECT * FROM " . DB_PREFIX . "pageContents WHERE Route = :route";

            $query = $dbConnection->prepare($query);
            $query->bindParam(':route', $this->route, PDO::PARAM_STR);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            return $query->fetch();
        } else {
            ErrorController::actionError500('Eternal server error. No page in system');
            return false;
        }
    }


    public function getHeader() {
        return include_once ROOT . CORE_PATH . '/views/layouts/header.php';
    }

    public function getFooter() {
        return include_once ROOT . CORE_PATH . '/views/layouts/footer.php';
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function getTemplatePath()
    {
        return ROOT.CORE_PATH.TEMPLATE_PATH.$this->template.'_template.php';
    }

}