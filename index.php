<?php

/**
 * FRONTEND CONTROLLER
 *
 * Стартовая точка работы проекта. Тут проводяться основные настройки и подключения файлов, а затем запуск функции обработки запросов.
 *
 */

// Общие настройки

putenv('APPLICATION_ENV=debug');
if (getenv('APPLICATION_ENV')) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

/**
 * Абсолютный путь
 */
define('ROOT', dirname(__FILE__));

// Подключение файлов системы
require_once(ROOT . '/library/Autoload.php');

$router = new Router();
$router->run();

/*echo '<pre>';
print_r($_SERVER);
echo '</pre>';*/