<?php

/**
 * FRONTEND CONTROLLER
 *
 * Стартовая точка работы проекта. Тут проводяться основные настройки и подключения файлов, а затем запуск функции обработки запросов.
 *
 */

// Общие настройки
$_SERVER['APPLICATION_ENV]'] = 'development';
if ($_SERVER['APPLICATION_ENV'] == 'development') {

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

}


/**
 * Абсолютный путь
 */
define('ROOT', dirname(__FILE__));

// Подключение файлов системы
require_once(ROOT . '/library/Autoload.php');


echo '<pre>';
print_r($_SERVER);
echo '</pre>';