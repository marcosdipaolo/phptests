<?php

namespace App\Http\Controllers;

use App\Abstracts\Repositories\AuthenticationAbstractRepository;
use Monolog\Logger;

class AuthController
{
    /** @var AuthenticationAbstractRepository $authenticationRepository */
    private $authenticationRepository;
    /** @var Logger $logger */
    private $logger;

    public function __construct()
    {
        $this->authenticationRepository = app()->get(AuthenticationAbstractRepository::class);
        $this->logger = setUpLogger('auth');
    }

    public function login()
    {
        try {
            if ($this->authenticationRepository->exceededThrottle(getRealIpAddr())) {
                redirect('/login', ['danger' => 'You\'ve been blocked. Please wait a minute.']);
            }
            if ($user = $this->authenticationRepository->authenticate(
                request('email'),
                request('password')
            )
            ) {
                auth()->login($user);
                redirect('/', ['success' => 'You\'ve been loggedd in!']);
                return true;
            }
            $this->authenticationRepository->createFailedLoginAttemp();
            redirect('/login', ['danger' => 'There is no user with those credentials']);
        } catch (\Throwable $e) {
            $this->logger->info($e->getMessage());
            return render('auth.login', ['danger' => $e->getMessage()]);
        }
    }

    public function loginForm()
    {
        if (auth()->user()) {
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
