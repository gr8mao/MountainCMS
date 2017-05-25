<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 13.05.17
 * Time: 15:27
 */
class PageManageController
{
    public static function actionIndex($page = 1)
    {
        if (User::checkLogged() and User::checkUserAdmin($_COOKIE['User'])) {

            $count = Page::getPageCount();

            $pagination = false;
            if ($count > 10) {
                $pagination = new Pagination($count, $page, 10, 'page-');
            }

            if (isset($_POST['filter'])) {
                // TODO search results render
            }

            $pages = Page::getPageList($page);

            include_once MTN_ROOT . MTN_ADMIN . TEMPLATES_PATH . '/pageManageTemplates/pageManageTemplate.php';
        } else {
            header('Location: /mtn-admin/login');
        }
        return true;
    }

    public static function actionAddNewPage()
    {
        if (User::checkLogged() and User::checkUserAdmin($_COOKIE['User'])) {

            $templatesList = Templates::getTemplatesList();
            $pageInfo = [];
            $errors = [];

            if (isset($_POST['formId'])) {
                $page_title = $_POST['page_title'];
                $page_route = $_POST['page_route'];
                $page_contents = $_POST['page_contents'];
                $page_description = $_POST['page_description'];
                $page_keywords = $_POST['page_keywords'];
                $page_status = $_POST['page_status'];
                $page_template = $_POST['page_template'];

                if ($page_title == '') {
                    $errors[] = 'Заголовок страницы не может быть пустым';
                }

                if ($page_route == '' or (stristr($page_route, '/') === false)) {
                    $errors[] = 'Задайте правильный путь к странице';
                }

                if ($page_status == '') {
                    $errors[] = 'Задайте статус к странице';
                }

                if ($page_template == '') {
                    $errors[] = 'Задайте путь к странице';
                }

                if(Page::checkPageExist($page_route)){
                    $errors[] = 'Такой путь уже существует на сайте';
                }

                if (!$errors) {
                    Page::addPage($page_title, $page_description, $page_keywords, $page_contents, $page_route, $page_status, $page_template);
                    header('Location: /mtn-admin/pages/');
                }
            }


            include_once MTN_ROOT . MTN_ADMIN . TEMPLATES_PATH . '/pageManageTemplates/addPageTemplate.php';
        } else {
            header('Location: /mtn-admin/login');
        }
        return true;
    }

    public static function actionEditPage($id)
    {
        if (User::checkLogged() and User::checkUserAdmin($_COOKIE['User'])) {
            if (!isset($_POST['formId'])) {
                $pageInfo = Page::getPageInfoById($id);
            } else {
                $warningMessage = 'Данные сохранены!';
                $pageInfo = $_POST;
            }

            $templatesList = Templates::getTemplatesList();

            $errors = [];
            if (isset($_POST['formId'])) {
                $page_title = $_POST['page_title'];
                $page_route = $_POST['page_route'];
                $page_contents = $_POST['page_contents'];
                $page_description = $_POST['page_description'];
                $page_keywords = $_POST['page_keywords'];
                $page_status = $_POST['page_status'];
                $page_template = $_POST['page_template'];

                if ($page_title == '') {
                    $errors[] = 'Заголовок страницы не может быть пустым';
                }

                if ($page_route == '' or (stristr($page_route, '/') === false)) {
                    $errors[] = 'Задайте правильный путь к странице';
                }

                if ($page_status == '') {
                    $errors[] = 'Задайте статус к странице';
                }

                if ($page_template == '') {
                    $errors[] = 'Задайте путь к странице';
                }

                if(Page::checkPageExist($page_route) and Page::getRouteById($id) != $page_route){
                    $errors[] = 'Такой путь уже существует на сайте';
                }

                if (!$errors) {
                    Page::updatePageInfo($id, $page_title, $page_description, $page_keywords, $page_contents, $page_route, $page_status, $page_template);
                    header('Location: /mtn-admin/pages/edit/id' . $id);
                }
            }

            include_once MTN_ROOT . MTN_ADMIN . TEMPLATES_PATH . '/pageManageTemplates/editPageTemplate.php';
        } else {
            header('Location: /mtn-admin/login');
        }
        return true;
    }

    public static function actionDeletePage($id)
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if (User::checkLogged() and User::checkUserAdmin($_COOKIE['User'])) {
                $result = Page::deletePage($id);
                if ($result == 1) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo false;
            }
            return true;
        }
    }
}