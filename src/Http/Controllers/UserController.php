<?php

namespace App\Http\Controllers;

use MDP\Router\Attributes\Get;

class UserController
{
    #[Get("/register")]
    public function registerForm()
    {
        if (auth()->user()) {
            redirect('/');
        }
        return render('auth.register');
    }
}
