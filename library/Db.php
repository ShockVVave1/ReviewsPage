<?php

/**
 * Class Db
 * Класс работающий с БД
 */
class Db
{
    /**
     * Возвращает соединение с БД
     * @return PDO
     */
    public static function getConnection()
    {
        //переменная с путём к конфигурационному файлу
        $paramsPath = ROOT . '/app/configs/db_params.php';

        //Подключение конфигурационного файла
        try {
            if (file_exists($paramsPath)) {
                $params = require($paramsPath);
            } else {
                throw new Exception("Настройки db не найдены");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }

        //Инициализация соединения с БД
        try {
            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            $db = new PDO($dsn, $params['user'], $params['password']);

            if ($_SERVER['APPLICATION_ENV'] == 'development') {
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            $db->exec('set names utf8');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $db;
    }
}