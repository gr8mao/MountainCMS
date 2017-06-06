<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 01.06.17
 * Time: 18:47
 */
class Comments
{
    public static function getCommentsList()
    {
        $DBConnection = Database::getDBConnection();

        $query = "SELECT * FROM " . DB_PREFIX . "comments WHERE com_done = 0 ORDER BY com_date DESC LIMIT 5";

        $result = $DBConnection->prepare($query);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function saveComment($content, $user)
    {
        $DBConnection = Database::getDBConnection();

        $query = "INSERT INTO " . DB_PREFIX . "comments(`com_content`, `com_user_id`) VALUES (:content, :userId)";

        $result = $DBConnection->prepare($query);
        $result->bindParam(':content', $content, PDO::PARAM_STR);
        $result->bindParam(':userId', $user, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function closeComment($id)
    {
        $DBConnection = Database::getDBConnection();

        $query = "UPDATE " . DB_PREFIX . "comments SET `com_done`=1 WHERE `com_id` = :id";

        $result = $DBConnection->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function getNewComments($id)
    {
        $DBConnection = Database::getDBConnection();

        $query = "SELECT * FROM " . DB_PREFIX . "comments WHERE com_done = 0 and com_id > :id ORDER BY com_date LIMIT 5";

        $result = $DBConnection->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $commentsList = [];
        $i = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $commentsList[$i]['id'] = $row['com_id'];
            $commentsList[$i]['author'] = User::getUsernameById($row['com_user_id']);
            $commentsList[$i]['content'] = $row['com_content'];
            $commentsList[$i]['date'] = $row['com_date'];
        }

        return $commentsList;
    }
}