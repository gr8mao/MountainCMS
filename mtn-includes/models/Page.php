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

        $this->contents = $pageConfig['page_contents'];
        $this->title = $pageConfig['page_title'];
        $this->description = $pageConfig['page_description'];
        $this->keywords = $pageConfig['page_keywords'];
        $this->template = $pageConfig['page_template'];
    }

    private function getPageConfig()
    {
        $dbConnection = Database::getDBConnection();

        if($dbConnection) {
            $query = "SELECT * FROM " . DB_PREFIX . "pageContents WHERE page_route = :route";

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
        $title = $this->title;
        $isAdmin = false;
        if(User::checkLogged()){
            if(User::checkUserAdmin($_COOKIE['User'])){
                $isAdmin = true;
                $username = User::getUsernameById($_COOKIE['User']);
            }
        }
        return include_once MTN_ROOT . MTN_CORE . '/views/layouts/header.php';
    }

    public function getFooter() {
        return include_once MTN_ROOT . MTN_CORE . '/views/layouts/footer.php';
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function getTemplatePath()
    {
        return MTN_ROOT.MTN_CORE.TEMPLATES_PATH.'/'.$this->template.'Template.php';
    }

}