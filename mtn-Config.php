<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.03.17
 * Time: 20:33
 */

/* Настройки базы данных */
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PSWD = 'root';
const DB_NAME = 'mountain_cms_db';
const DB_PREFIX = 'mtn_';

/* Настройки Redis */

const REDIS_INIT = true;
const REDIS_HOST = "127.0.0.1";
const REDIS_PORT = 6375;

/* Пути в системе */
define('MTN_ROOT', dirname(__FILE__)); // define ROOT directory
define('MTN_CORE', '/mtn-core'); // define CORE directory
define('MTN_ADMIN', '/mtn-admin'); // define ADMIN directory

const TEMPLATES_PATH = '/views/templates';
const MTN_INC = '/mtn-includes';
const ASSETS_PATH = MTN_INC.'/assets';

/* Настройки безопасности */

const SECURITY_KEY = '34857d973953e44afb49ea9d61104d8c';
const SECURITY_IV  = '34857d973953e44afb49ea9d61104d8c';

/* Настройки сайта */
const MTN_DEBUG = true;