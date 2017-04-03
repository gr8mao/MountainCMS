<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 27.03.17
 * Time: 13:22
 */
final class RedisStorage
{
    protected static $instance;
    private $RedisConnection;

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
    }

    public static function getRedisConnection() {
    }
}