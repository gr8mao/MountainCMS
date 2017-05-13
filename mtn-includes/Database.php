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
    private static $dbConnection;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct()
    {
    }

    public function __wakeup()
    {
    }

    public function __clone()
    {
    }

    public static function initConnection()
    {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";

        try {
            self::$dbConnection = new PDO ($dsn, DB_USER, DB_PSWD);
            if (MTN_DEBUG) {
                self::$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$dbConnection;
        } catch (PDOException $e) {
            ErrorController::actionDbError("I was unable to open a connection to the database. " . $e->getMessage());
        }
        return null;
    }

    public static function getDBConnection() : PDO
    {
        return self::$dbConnection;
    }
}