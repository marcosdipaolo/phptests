<?php

namespace App\Http\Controllers;

use App\Abstracts\ConnectionInterface;
use App\Abstracts\Repositories\UserAbstractRepository;
use App\Abstracts\Repositories\ProfileAbstractRepository;
use App\Entities\Profile;
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
        private readonly ProfileAbstractRepository $profileRepository,
        private readonly ConnectionInterface $conn,
    ) {
        $this->logger = setUpLogger('auth');
        $this->auth = auth($this->conn->getPDO());
        // since Auth PDO instance does not know anything about our doctrine lifecycle hooks
        $this->auth->enableTimestamps();
    }

    #[Post("/register")]
    public function register()
    {
        try {
            /**
             * we use the Auth package to register a user
             * getting back an Authenticatable, which is
             * an object with the id, email, username
             * and hashed password
             */
            $authenticatedUser = $this->auth
                ->register(
                    request('username'),
                    request('email'),
                    request('password')
                );
            /**
             * We log in the user
             */
            auth()->login($authenticatedUser);
            if(!getLoggedUser()) throw new \Exception(
                "Profile wasn't create eiter because we couldn't" .
                " register the user, or we couln't log him in."
            );
            $this->profileRepository->save(new Profile());
            return render('index', [
                'success' => 'User registered',
            ]);
        } catch (Throwable $e) {
            return render('auth.register', ['danger' => $e->getMessage()]);
        }
    }

    #[Post("/login")]
    public function login(): bool
    {
        try {
            if (!!env("THROTTLE_LOGIN") && $this->auth->exceededFailedLoginAttempts(getRealIpAddr())) {
                redirect('/login', ['danger' => 'You\'ve been blocked. Please wait a minute.']);
            }
            if ($this->auth->check(
                $email = request('email'),
                request('password')
            )) {
                /** @var Authenticatable $user */
                $user = $this->userRepository->findByEmail($email);
                auth()->login($user);
                redirect('/', ['success' => 'You\'ve been loggedd in!']);
            }
            $this->auth->createFailedLoginAttempt(getRealIpAddr());
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
