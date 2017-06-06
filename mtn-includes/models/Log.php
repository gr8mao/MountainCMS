<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 01.06.17
 * Time: 11:33
 */
class Log
{
    public static function logAccess()
    {
        $DBConnection = Database::getDBConnection();

        $query = "INSERT INTO `" . DB_PREFIX . "log`(`log_user`, `log_ip`) VALUES (:user,:ip)";

        $user = User::checkLogged();
        if (!$user) {
            $user = '';
        }
        $ip = self::getClientIp();

        $result = $DBConnection->prepare($query);
        $result->bindParam(':user', $user, PDO::PARAM_STR);
        $result->bindParam(':ip', $ip, PDO::PARAM_STR);
        return $result->execute();
    }

    private static function getClientIp()
    {
        $ipAddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipAddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipAddress = 'UNKNOWN';
        return $ipAddress;
    }

    public static function getViewStatistic()
    {
        $DBConnection = Database::getDBConnection();

        $query = "SELECT log_id, log_date FROM " . DB_PREFIX . "log WHERE year(log_date) = year(now()) and log_date > NOW() - INTERVAL 7 DAY";

        $result = $DBConnection->prepare($query);
        $result->execute();

        $logList = $result->fetchAll(PDO::FETCH_ASSOC);

        $i = 0;
        $count = 0;
        $currentDate = strtotime($logList[0]['log_date']);
        $resultList = [];
        foreach ($logList as $log) {
            $date = strtotime($log['log_date']);
            $day = getdate($date);
            $curDateInfo = getdate($currentDate);
            if ($curDateInfo['mday'] == $day['mday']) {
                $count++;
            } else {
                $resultList[$i]['count'] = $count;
                $resultList[$i]['date'] = $curDateInfo['mday'].'-'.$curDateInfo['mon'].'-'.$curDateInfo['year'];
                $count = 0;
                $currentDate = $date;
                $i++;
            }
        }

        $resultList[$i]['count'] = $count;
        $resultList[$i]['date'] = $day['mday'].'-'.$day['mon'].'-'.$day['year'];

        return $resultList;
    }

    public static function getWeekViewsCount()
    {
        $DBConnection = Database::getDBConnection();

        $query = "SELECT count(*) as c FROM " . DB_PREFIX . "log WHERE year(log_date) = year(now()) and log_date > NOW() - INTERVAL 7 DAY";

        $result = $DBConnection->prepare($query);
        $result->execute();

        return $result->fetch()['c'];
    }

    public static function getWeekVisitorsCount()
    {
        $DBConnection = Database::getDBConnection();

        $query = "SELECT log_ip FROM " . DB_PREFIX . "log WHERE year(log_date) = year(now()) and log_date > NOW() - INTERVAL 7 DAY";

        $result = $DBConnection->prepare($query);
        $result->execute();

        $resultList = [];
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $resultList[] = $row['log_ip'];
        }

        return count(array_count_values($resultList));
    }

    public static function getWeekVisitorsStatistic()
    {
        $DBConnection = Database::getDBConnection();

        $query = "SELECT log_ip, log_date FROM " . DB_PREFIX . "log WHERE year(log_date) = year(now()) and log_date > NOW() - INTERVAL 7 DAY";

        $result = $DBConnection->prepare($query);
        $result->execute();

        $logList = $result->fetchAll(PDO::FETCH_ASSOC);

        $i = 0; $j = 0;
        $count = [];
        $currentDate = strtotime($logList[0]['log_date']);
        $resultList = [];
        foreach ($logList as $log) {
            $date = strtotime($log['log_date']);
            $day = getdate($date);
            $curDateInfo = getdate($currentDate);
            if ($curDateInfo['mday'] == $day['mday']) {
                $count[] = $log['log_ip'];
            } else {
                $resultList[$i]['count'] = count(array_count_values($count));
                $resultList[$i]['date'] = $curDateInfo['mday'].'-'.$curDateInfo['mon'].'-'.$curDateInfo['year'];
                $count = [];
                $currentDate = $date;
                $i++;
                $j = 0;
            }
        }

        $resultList[$i]['count'] = count(array_count_values($count));
        $resultList[$i]['date'] = $day['mday'].'-'.$day['mon'].'-'.$day['year'];

        return $resultList;
    }
}