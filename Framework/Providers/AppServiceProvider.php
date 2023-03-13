<?php declare(strict_types=1);

namespace MDP\Framework\Providers;

use App\Abstracts\ConnectionInterface;
use App\Abstracts\Repositories\FailedLoginAttemptAbstractRepository;
use App\Abstracts\Repositories\EmailAbstractRepository;
use App\Abstracts\Repositories\UserAbstractRepository;
use App\Repositories\FailedLoginAttemptRepository;
use App\Repositories\EmailRepository;
use App\Repositories\UserRepository;
use MDP\DB\Connection;
use MDP\Container\Container;

class AppServiceProvider
{
    private static Container | NULL $container = NULL;
    private static array $bindings = [
        EmailAbstractRepository::class => EmailRepository::class,
        UserAbstractRepository::class => UserRepository::class,
        FailedLoginAttemptAbstractRepository::class => FailedLoginAttemptRepository::class,
        ConnectionInterface::class => Connection::class
    ];

    public static function registerContainer(): Container
    {
        if (self::$container instanceof Container) return self::$container;
        $container = new Container();
        foreach (self::$bindings as $abstract => $concrete) {
            $container->set($abstract, $concrete);
        }
        self::$container = $container;
        return $container;
    }
}
