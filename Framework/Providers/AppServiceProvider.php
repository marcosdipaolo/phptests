<?php declare(strict_types=1);

namespace MDP\Framework\Providers;

use App\Abstracts\ConnectionInterface;
use App\Abstracts\Repositories\FailedLoginAttemptAbstractRepository;
use App\Abstracts\Repositories\EmailAbstractRepository;
use App\Abstracts\Repositories\ProfileAbstractRepository;
use App\Abstracts\Repositories\UserAbstractRepository;
use App\Repositories\FailedLoginAttemptRepository;
use App\Repositories\EmailRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\UserRepository;
use MDP\DB\Connection;
use MDP\Container\Container;

class AppServiceProvider
{
    private static Container | NULL $container = NULL;
    private static array $bindings = [
        // Abstract => Concrete
        EmailAbstractRepository::class => EmailRepository::class,
        UserAbstractRepository::class => UserRepository::class,
        FailedLoginAttemptAbstractRepository::class => FailedLoginAttemptRepository::class,
        ConnectionInterface::class => Connection::class,
        ProfileAbstractRepository::class => ProfileRepository::class
    ];

    /**
     * We create a container, load all bindings into it and return it
     */
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
