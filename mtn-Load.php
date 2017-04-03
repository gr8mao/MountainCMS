<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 28.03.17
 * Time: 13:52
 */

/*
 * Подключаем конфигурационный файл системы
 *
 * Если файла нет, включаем файл инициализации системы TODO: Not implemented yet
 *
 */
if(!file_exists('mtn-Config.php')) {
    include_once 'mtn-Install.php'; //TODO: Not implemented yet
} else {
    include_once 'mtn-Config.php';
}

if(!defined('MTN_INC')){
    die('No includes path');
}

include_once MTN_ROOT.MTN_INC.'/autoload.php';

if(MTN_DEBUG){
    ini_set('display_errors','1');
    error_reporting(E_ALL);
}

Database::initConnection();

$router = new CoreRouter();
$router->run();