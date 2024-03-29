<?php

/**
 * FRONTEND CONTROLLER
 *
 * Стартовая точка работы проекта. Тут проводяться основные настройки и подключения файлов, а затем запуск функции обработки запросов.
 *
 */

// Общие настройки

$_SERVER['APPLICATION_ENV']='development';
if ($_SERVER['APPLICATION_ENV'] == 'development') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

//Абсолютный путь
define('ROOT', dirname(__FILE__));

// Подключение файлов системы
require_once(ROOT . '/library/Autoload.php');

//include_once ROOT.'/database/setupScript.php';

//Создание и инициализация маршрутизатора
$router = new Router();
$router->run();

