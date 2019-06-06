<?php

//Массив рутов
$routes = array(

    '(page[=][ 0-9]+)' => 'review/index/$1',
    '' => 'review/index',
);

return $routes;