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
    private $status;

    public function __construct($route)
    {
        if ($route === '') {
            $this->route = '/';
        } else {
            $this->route = $route;
        }

        self::initPage();

    }

    private function initPage()
    {
        $pageConfig = self::getPageConfig();


        $this->contents = $pageConfig['page_contents'];
        $this->title = $pageConfig['page_title'];
        $this->description = $pageConfig['page_description'];
        $this->keywords = $pageConfig['page_keywords'];
        $this->template = $pageConfig['page_template'];
        $this->status = $pageConfig['page_status'];

    }

    public function getStatus()
    {
        return $this->status;
    }

    private function getPageConfig()
    {
        $dbConnection = Database::getDBConnection();

        if ($dbConnection) {
            $query = "SELECT * FROM " . DB_PREFIX . "pageContents WHERE page_route = :route";

            $query = $dbConnection->prepare($query);
            $query->bindParam(':route', $this->route, PDO::PARAM_STR);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            return $query->fetch();
        } else {
            ErrorController::actionError500('Eternal server error.');
            return false;
        }
    }


    public function getHeader()
    {
        $title = $this->title;
        $isAdmin = false;
        if (User::checkLogged()) {
            if (User::checkUserAdmin($_COOKIE['User'])) {
                $isAdmin = true;
                $username = User::getUsernameById(User::checkLogged());
            }
        }
        return include_once MTN_ROOT . MTN_CORE . '/views/layouts/header.php';
    }

    public function getFooter()
    {
        return include_once MTN_ROOT . MTN_CORE . '/views/layouts/footer.php';
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function getTemplatePath()
    {
        return MTN_ROOT . MTN_CORE . TEMPLATES_PATH . '/' . $this->template . 'Template.php';
    }

    public static function getPageList($page = 1, $count = 10)
    {
        $DBConnection = Database::getDBConnection();

        $limit = $count;
        // Смещение (для запроса)
        $offset = ($page - 1) * $count;

        $query = "SELECT * FROM " . DB_PREFIX . "pageContents ORDER BY page_create_date DESC LIMIT :limit OFFSET :offset";

        $result = $DBConnection->prepare($query);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPageInfoById($id)
    {
        $DBConnection = Database::getDBConnection();

        $query = "SELECT * FROM " . DB_PREFIX . "pageContents WHERE page_id = :id LIMIT 1";

        $result = $DBConnection->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function getPageCount()
    {
        $DBConnection = Database::getDBConnection();

        $query = "SELECT count(*) AS c FROM " . DB_PREFIX . "pageContents";

        $result = $DBConnection->prepare($query);
        $result->execute();

        return $result->fetch()['c'];
    }

    public static function updatePageInfo($id, $page_title, $page_description, $page_keywords, $page_contents, $page_route, $page_status, $page_template)
    {
        $page_modify_date = date('Y-m-d H:i:s', time());
        $page_lastModBy = User::checkLogged();

        $DBConnection = Database::getDBConnection();

        $query = "UPDATE `" . DB_PREFIX . "pageContents` SET
        `page_title` = :page_title,
        `page_description` = :page_description,
        `page_keywords` = :page_keywords,
        `page_contents` = :page_contents,
        `page_route` = :page_route,
        `page_lastModBy` = :page_lastModBy,
        `page_template` = :page_template,
        `page_modify_date` = :page_modify_date,
        `page_status` = :page_status WHERE `page_id` = :id";

        $result = $DBConnection->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':page_title', $page_title, PDO::PARAM_STR);
        $result->bindParam(':page_description', $page_description, PDO::PARAM_STR);
        $result->bindParam(':page_keywords', $page_keywords, PDO::PARAM_STR);
        $result->bindParam(':page_contents', $page_contents, PDO::PARAM_STR);
        $result->bindParam(':page_route', $page_route, PDO::PARAM_STR);
        $result->bindParam(':page_lastModBy', $page_lastModBy, PDO::PARAM_INT);
        $result->bindParam(':page_template', $page_template, PDO::PARAM_STR);
        $result->bindParam(':page_modify_date', $page_modify_date, PDO::PARAM_STR);
        $result->bindParam(':page_status', $page_status, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function addPage($page_title, $page_description, $page_keywords, $page_contents, $page_route, $page_status, $page_template)
    {
        $page_modify_date = date('Y-m-d H:i:s', time());
        $page_lastModBy = User::checkLogged();

        $DBConnection = Database::getDBConnection();

        $query = "INSERT INTO `" . DB_PREFIX . "pageContents`
            (`page_title`, `page_description`, `page_keywords`,
             `page_contents`, `page_route`,
             `page_lastModBy`, `page_template`, `page_create_date`,
             `page_modify_date`, `page_added_by`, `page_status`)
            VALUES (
                :page_title, :page_description, :page_keywords,
                :page_contents, :page_route,
                :page_lastModBy, :page_template, :page_create_date,
                :page_modify_date, :page_added_by, :page_status)";

        $result = $DBConnection->prepare($query);
        $result->bindParam(':page_title', $page_title, PDO::PARAM_STR);
        $result->bindParam(':page_description', $page_description, PDO::PARAM_STR);
        $result->bindParam(':page_keywords', $page_keywords, PDO::PARAM_STR);
        $result->bindParam(':page_contents', $page_contents, PDO::PARAM_STR);
        $result->bindParam(':page_route', $page_route, PDO::PARAM_STR);
        $result->bindParam(':page_lastModBy', $page_lastModBy, PDO::PARAM_INT);
        $result->bindParam(':page_added_by', $page_lastModBy, PDO::PARAM_INT);
        $result->bindParam(':page_template', $page_template, PDO::PARAM_STR);
        $result->bindParam(':page_modify_date', $page_modify_date, PDO::PARAM_STR);
        $result->bindParam(':page_create_date', $page_modify_date, PDO::PARAM_STR);
        $result->bindParam(':page_status', $page_status, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function checkPageExist($path)
    {
        $DBConnection = Database::getDBConnection();

        $query = "SELECT page_id FROM " . DB_PREFIX . "pageContents WHERE page_route = :path";

        $result = $DBConnection->prepare($query);
        $result->bindParam(':path', $path, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public static function deletePage($id)
    {
        $DBConnection = Database::getDBConnection();

        $query = "DELETE FROM " . DB_PREFIX . "pageContents WHERE page_id = :page_id";

        $result = $DBConnection->prepare($query);
        $result->bindParam(':page_id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function getRouteById($id)
    {
        $DBConnection = Database::getDBConnection();

        $query = "SELECT page_route FROM " . DB_PREFIX . "pageContents WHERE page_id = :page_id";

        $result = $DBConnection->prepare($query);
        $result->bindParam(':page_id', $id, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getPageStatus($path)
    {
        $DBConnection = Database::getDBConnection();

        $query = "SELECT page_status FROM " . DB_PREFIX . "pageContents WHERE page_route = :page_route";

        $result = $DBConnection->prepare($query);
        $result->bindParam(':page_route', $path, PDO::PARAM_STR);
        $result->execute();

        return $result->fetch();
    }

    public static function getLatestPages()
    {
        $DBConnection = Database::getDBConnection();

        $query = "SELECT page_id, page_title, page_route, page_modify_date FROM " . DB_PREFIX . "pageContents WHERE page_modify_date < CURRENT_TIME ORDER BY page_modify_date DESC LIMIT 5";

        $result = $DBConnection->prepare($query);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}