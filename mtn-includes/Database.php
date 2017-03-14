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
    private $dbConnection;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct(){}

    public function __wakeup(){}

    public function __clone(){}

    private static function initConnection(){
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";

        try {
            $db = self::getInstance();
            $db->dbConnection = new PDO ($dsn, DB_USER, DB_PSWD);
            $db->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db->dbConnection;
        } catch (PDOException $e) {
            ErrorController::actionError500('Database connection error');
        }
        return null;
    }

    public static function getDBConnection() {
        try {
            $db = self::initConnection();
            return $db;
        } catch (Exception $e) {
            ErrorController::actionError500("I was unable to open a connection to the database. " . $e->getMessage());
            return null;
        }
    }
}