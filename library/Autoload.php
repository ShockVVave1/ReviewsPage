<?php


/**
 * Функция автозагрузчика классов
 *
 * @param $class_name
 *
 */
function component_autoload($class_name)
{
    //возможные дирректории классов
    $array_paths = array(
        '/app/controllers/',
        '/app/models/',
        '/app/views/',
        '/library/'
    );

    //Перебор возможных категорий
    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            require_once($path);
        }
    }
}

//Регистрация автозагрузчика
spl_autoload_register('component_autoload');
echo 'Автозагрузчик подключен';