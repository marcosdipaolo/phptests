<?php

namespace App\Http\Controllers;

use App\Abstracts\ConnectionInterface;
use App\Abstracts\Repositories\FailedLoginAttemptAbstractRepository;
use App\Abstracts\Repositories\UserAbstractRepository;
use MDP\Auth\Auth;
use MDP\Auth\Authenticatable;
use Monolog\Logger;

class AuthController
{
    private Logger $logger;
    private Auth $auth;

    public function __construct(
        private UserAbstractRepository $userRepository,
        private ConnectionInterface $conn,
        private FailedLoginAttemptAbstractRepository $authenticationRepository
    )
    {
        $this->logger = setUpLogger('auth');
        $this->auth = auth($this->conn->getEntityManager());
    }

    public function register()
    {
        try {
            $this->auth->register(
                request('username'), $email = request('email'), request('password')
            );
            /** @var Authenticatable $user */
            $user = $this->userRepository->findByEmail($email);
            auth()->login($user);
            return render('index', [
                'success' => 'User registered'
            ]);
        } catch (\Throwable $e) {
            return render('auth.register', ['danger', 'Snap!, ' . $e->getMessage()]);
        }
    }

    public function login()
    {
        try {
            if ($this->authenticationRepository->exceededThrottle(getRealIpAddr())) {
                redirect('/login', ['danger' => 'You\'ve been blocked. Please wait a minute.']);
            }
            if ($this->auth->check(
                    $email = request('email'),
                    request('password')
                )
            ) {

                /** @var Authenticatable $user */
                $user = $this->userRepository->findByEmail($email);
                auth()->login($user);
                redirect('/', ['success' => 'You\'ve been loggedd in!']);
                return true;
            }
            $this->authenticationRepository->createFailedLoginAttempt();
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
