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
    private static array $bindings = [
        EmailAbstractRepository::class => EmailRepository::class,
        UserAbstractRepository::class => UserRepository::class,
        AuthenticationAbstractRepository::class => AuthenticationRepository::class,
        ConnectionInterface::class => Connection::class
    ];

    public static function registerContainer(): Container
    {
        $container = new Container();
        foreach (self::$bindings as $abstract => $concrete) {
            $container->set($abstract, $concrete);
        }
        return $container;
    }
}
