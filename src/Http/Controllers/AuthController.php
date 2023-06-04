<?php

namespace App\Http\Controllers;

use App\Abstracts\ConnectionInterface;
use App\Abstracts\Repositories\FailedLoginAttemptAbstractRepository;
use App\Abstracts\Repositories\UserAbstractRepository;
use App\Entities\User;
use MDP\Auth\Auth;
use MDP\Auth\Authenticatable;
use MDP\Container\Exceptions\ContainerException;
use MDP\Container\Exceptions\NotFoundException;
use Monolog\Logger;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class AuthController
{
    private Logger $logger;
    private Auth $auth;

    public function __construct(
        private readonly UserAbstractRepository $userRepository,
        private readonly ConnectionInterface $conn,
        private readonly FailedLoginAttemptAbstractRepository $authenticationRepository
    )
    {
        $this->logger = setUpLogger('auth');
        $this->auth = auth($this->conn->getPDO());
    }

    public function register()
    {
        try {
            $user = new User();
            $user->setEmail(request('email'));
            $user->setUsername(request('username'));
            $user->setPassword(password_hash(request('password'), PASSWORD_BCRYPT));
            $user = $this->userRepository->save($user);
            auth()->login($user);
            return render('index', [
                'success' => 'User registered'
            ]);
        } catch (\Throwable $e) {
            return render('auth.register', ['danger' => 'Snap!, ' . $e->getMessage()]);
        }
    }

    public function login(): bool
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
            }
            $this->authenticationRepository->createFailedLoginAttempt();
            redirect('/login', ['danger' => 'There is no user with those credentials']);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());
            setFlashMessages(['danger' => $e->getMessage()]);
            return render('auth.login');
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
        redirect('/', ['success' => 'You logged out successfuly']);
    }
}
