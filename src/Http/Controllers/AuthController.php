<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

class AuthController
{
    /** @var UserRepository $userRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        try {
            if ($user = $this->userRepository->authenticate(
                request()->email, request()->password)
            ) {
                auth()->login($user);
                redirect('/', ['success' => 'You\'ve been loggedd in!']);
                return true;
            }
            redirect('/login', ['danger' => 'There is no user with those credentials']);
        } catch (\Throwable $e) {
            return render('auth.login', ['danger' => $e->getMessage()]);
        }
    }

    public function loginForm()
    {
        if(auth()->user()) {
            redirect('/');
        }
        return render('auth.login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/', ['success' => 'You logged out successfuly']);
    }
}