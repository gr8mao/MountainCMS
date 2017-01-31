<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 31.01.17
 * Time: 21:49
 */
final class Database
{
    protected static $instance;

    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private static function __construct()
    {
        $dbParamsPath = ROOT . '/config/dbParams.php';
        $dbParams = include $dbParamsPath;

        $dsn = "mysql:host={$dbParams['host']};dbname={$dbParams['dbname']};charset=utf8";
        try {
            $db = new PDO ($dsn, $dbParams['user'], $dbParams['password']);
        } catch (PDOException $e) {
            ErrorController::actionError500('Database connection error');
        }
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
        
    }

    public static function __wakeup()
    {
        
    }

    public static function __clone()
    {
        
    }
}