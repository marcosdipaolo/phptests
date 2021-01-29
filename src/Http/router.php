<?php
return [
    "get" => [
        ['/', 'PageController@index'],
        ['/mail', 'PageController@mail'],
        ['/login', 'AuthController@loginForm'],
        ['/register', 'UserController@registerForm'],
        ['/logout', 'AuthController@logout'],
        ['/about', 'PageController@about']
    ],
    "post" => [
        ['/mail', 'MailController@mail'],
        ['/register', 'AuthController@register'],
        ['/login', 'AuthController@login']
    ],
];

