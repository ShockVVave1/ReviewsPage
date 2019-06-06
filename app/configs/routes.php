<?php

//Массив рутов
$routes = array(

    '(page[=][a-z A-Z 0-9]+)' => 'review/index/$1',
    '' => 'review/index',
);

return $routes;