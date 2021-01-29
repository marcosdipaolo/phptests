<?php

namespace App\Http\Controllers;

class UserController
{
    public function registerForm()
    {
        if (auth()->user()) {
            redirect('/');
        }
        return render('auth.register');
    }
}
