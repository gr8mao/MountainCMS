<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.03.17
 * Time: 23:50
 */
class IndexController
{
    public static function actionIndex()
    {
        if (User::checkLogged() and User::checkUserAdmin($_COOKIE['User'])) {

            $pageCount = Page::getPageCount();
            $userCount = User::getUserCount();

            $latestPages = Page::getLatestPages();
            $latestUsers = User::getLatestUsers();

            $commentsList = Comments::getCommentsList();

            $viewStatistic = Log::getViewStatistic();
            $weekViewsCount = Log::getWeekViewsCount();

            $uniqCount = Log::getWeekVisitorsCount();
            $uniqStatictics = Log::getWeekVisitorsStatistic();

            include_once MTN_ROOT . MTN_ADMIN . TEMPLATES_PATH . '/indexTemplate.php';
        } else {
            header('Location: /mtn-admin/login');
        }

        return true;
    }


    public static function actionSaveComment()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if (User::checkLogged()) {
                $commentContent = $_POST['comment_content'];

                if (isset($commentContent)) {
                    if (Comments::saveComment($commentContent, User::checkLogged())) {
                        echo true;
                    } else {
                        echo false;
                    }
                }
            } else {
                echo false;
            }
            return true;
        }
        return true;
    }

    public static function actionGetNewComments()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if (User::checkLogged()) {
                $newComments = Comments::getNewComments($_POST['lastId']);
                if ($newComments) {
                    echo json_encode($newComments);
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
            return true;
        }
        return true;
    }

    public static function actionCheckComment()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            if (User::checkLogged()) {
                $id = intval($_POST['comment_id']);
                if (Comments::closeComment($id)) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
            return true;
        }
        return true;
    }
}