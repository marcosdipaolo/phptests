<?php

$router->get('/', 'PageController@index');
$router->get('/mail', 'PageController@mail');
$router->post('/mail', 'MailController@mail');
$router->get('/about', 'PageController@about');