<?php

namespace App\Framework;

use App\Models\User;

class Auth
{
    /**
     * @param string $password
     * @return false|string|null
     */
    public function hash(string $password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function user()
    {
        return session()->get('user');
    }

    public function login(User $user)
    {
        session()->put('user', $user);
    }

    public function logout()
    {
        session()->forget('user');
    }
}