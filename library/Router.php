<?php

/**
 * Class Router - Машрутизатор
 */
class Router
{
    /**
     * Router constructor.
     */
    public function __construct()
    {
        //переменная с путем к файлу маршрутов
        $routes_path = ROOT . '/app/configs/routes.php';

        //подключения файла маршрутов
        try {
            if (!file_exists($routes_path)) {
                throw new Exception('Руты не найдены');
            } else {
                $this->routes = require_once($routes_path);
            };
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Получение uri запроса
     */
    public function getUri()
    {

        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }


    /**
     * Машрутизация запроса
     */
    public function run()
    {
        $uri = $this->getUri();
        $uri = urldecode($uri);

        //Цикл проверки запроса на совпадение с рутами
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match('~^' . $uriPattern . '$~', $uri)) {

                //количество подмасок в пути
                $mask_count = substr_count($path, '$');

                /*
                //количество параметров в запросе
                $param_count = substr_count($uri, '?');

                //если есть параметры добавляем в путь подмаску
                if ($param_count > 0) {
                    $path .= '/$' . ($mask_count + 1);
                }
                   */
                //Получение внутреннего маршрута
                $internalPath = preg_replace('~^' . $uriPattern . '$~', $path, $uri);

                //Деление внутреннего маршрута на сегменты
                $segments = explode('/', $internalPath);

                //Получение имени контроллера
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                //Получение имени метода
                $actionName = 'action' . ucfirst(array_shift($segments));

                //Получение параметров
                $params = $segments;

                //Подключение файлов контроллера
                $controllerFile = ROOT . '/app/controllers/' . $controllerName . '.php';
                try {
                    if (file_exists($controllerFile)) {
                        include_once($controllerFile);
                    } else {
                        throw new Exception('Контроллер не найден');
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }

                //Создание экземпляра контроллера
                $controllerObject = new $controllerName();

                //Вызов метода
                $result = $controllerObject->$actionName($params);

                if ($result != null) {
                    die();
                }
            }
        }
    }

}