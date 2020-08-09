<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;

class UserController
{
    /** @var UserRepository $userRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register()
    {
        try {
            $user = new User();
            $user->setUsername(request()->username)
                ->setEmail(request()->email)
                ->setPassword(auth()->hash(request()->password));
            $user = $this->userRepository->save($user);
            auth()->login($user);
            return render('index', [
                'success' => 'User registered'
            ]);
        } catch(\Throwable $e) {
            return render('auth.register', ['danger', 'Snap!, ' . $e->getMessage()]);
        }
    }

    public function registerForm()
    {
        if(auth()->user()) {
            redirect('/');
        }
        return render('auth.register');
    }
}