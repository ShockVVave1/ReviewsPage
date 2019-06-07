<?php

//Массив рутов
$routes = array(

    'page=([ 0-9]+)((?:[& ?][a-z]+[=][a-z A-Z 0-9]+)+)' => 'review/index/$1',
    'page=([ 0-9]+)' => 'review/index/$1',
    'page=([ 0-9]+)' => 'review/index/$1',
    '((?:[& ?][a-z]+[=][a-z A-Z 0-9]+)+)' => 'review/index',

    'review/add' => 'review/add',
    'millione' => 'review/millione',
    '' => 'review/index',
);

return $routes;