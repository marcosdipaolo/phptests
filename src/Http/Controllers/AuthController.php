<?php

namespace App\Http\Controllers;

use App\Abstracts\ConnectionInterface;
use App\Abstracts\Repositories\FailedLoginAttemptAbstractRepository;
use App\Abstracts\Repositories\UserAbstractRepository;
use App\Entities\User;
use JetBrains\PhpStorm\NoReturn;
use MDP\Auth\Auth;
use MDP\Auth\Authenticatable;
use MDP\Router\Attributes\Get;
use MDP\Router\Attributes\Post;
use Monolog\Logger;
use Throwable;

class AuthController
{
    private Logger $logger;
    private Auth $auth;

    public function __construct(
        private readonly UserAbstractRepository $userRepository,
        private readonly ConnectionInterface $conn,
        private readonly FailedLoginAttemptAbstractRepository $authenticationRepository
    ) {
        $this->logger = setUpLogger('auth');
        $this->auth = auth($this->conn->getPDO());
    }

    #[Post("/register")]
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
                'success' => 'User registered',
            ]);
        } catch (Throwable $e) {
            return render('auth.register', ['danger' => 'Snap!, ' . $e->getMessage()]);
        }
    }

    #[Post("/login")]
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
        } catch (Throwable $e) {
            $this->logger->error($e->getMessage());
            setFlashMessages(['danger' => $e->getMessage()]);
            return render('auth.login');
        }
    }

    #[Get("/login")]
    public function loginForm()
    {
        if (auth()->user()) {
            redirect('/');
        }
        return render('auth.login');
    }

    #[NoReturn]
    #[Get("/logout")]
    public function logout(): void
    {
        auth()->logout();
        redirect('/', ['success' => 'You logged out successfuly']);
    }
}
