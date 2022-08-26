<?php declare(strict_types=1);

namespace App\Framework\Providers;

use App\Abstracts\ConnectionInterface;
use App\Abstracts\Repositories\AuthenticationAbstractRepository;
use App\Abstracts\Repositories\EmailAbstractRepository;
use App\Abstracts\Repositories\UserAbstractRepository;
use App\Repositories\AuthenticationRepository;
use App\Repositories\EmailRepository;
use App\Repositories\UserRepository;
use DB\Connection;
use MDP\Container\Container;

class AppServiceProvider
{

    public static function register(): Container
    {
        $container = new Container();
        $container->set(EmailAbstractRepository::class, EmailRepository::class);
        $container->set(UserAbstractRepository::class, UserRepository::class);
        $container->set(
            AuthenticationAbstractRepository::class, AuthenticationRepository::class
        );
        $container->set(ConnectionInterface::class, Connection::class);
        return $container;
    }
}
