<?php

namespace App\Http\Controllers;

use App\Repositories\AuthenticationRepository;
use App\Repositories\UserRepository;

class AuthController
{
    /** @var AuthenticationRepository $authenticationRepository */
    private $authenticationRepository;

    public function __construct(AuthenticationRepository $authenticationRepository)
    {
        $this->authenticationRepository = $authenticationRepository;
    }

    public function login()
    {
        try {
            if ($user = $this->authenticationRepository->authenticate(
                request()->email, request()->password)
            ) {
                auth()->login($user);
                redirect('/', ['success' => 'You\'ve been loggedd in!']);
                return true;
            }
            $this->authenticationRepository->createFailedLoginAttemp();
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