<?php

$router->get('/', 'PageController@index');
$router->get('/mail', 'PageController@mail');
$router->post('/mail', 'MailController@mail');
$router->get('/register', 'UserController@registerForm');
$router->post('/register', 'UserController@register');
$router->get('/login', 'AuthController@loginForm');
$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');
$router->get('/about', 'PageController@about');
