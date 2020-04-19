<?php

$router->get('/', 'PageController@index');
$router->get('/about', 'PageController@about');
$router->get('/closure', function(){
    render('header');
    echo '<main class="content">
            <div class="container">
                <h1>Closure</h1>
            </div>
        </main>';
    render('footer');
});