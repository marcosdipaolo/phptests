<?php

use App\Models\Router;

/** @var Router $router */
$router->get('/', 'PageController@index');
$router->get('/about', 'PageController@about');
$router->get('/closure', function(){
    require './src/Views/header.view.php';
    echo '<h1>lvdfsjfsjvn</h1>';
    require './src/Views/footer.view.php';
});