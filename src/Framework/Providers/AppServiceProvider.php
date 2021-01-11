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
use League\Container\Container;
use League\Container\ServiceProvider\AbstractServiceProvider;

class AppServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        EmailAbstractRepository::class,
        UserAbstractRepository::class,
        AuthenticationAbstractRepository::class,
        ConnectionInterface::class
    ];

    public function register()
    {
        /** @var Container $container */
        $container = $this->getContainer();
        $container->add(EmailAbstractRepository::class, EmailRepository::class);
        $container->add(UserAbstractRepository::class, UserRepository::class);
        $container->add(
            AuthenticationAbstractRepository::class, AuthenticationRepository::class
        )->addArgument(UserAbstractRepository::class);
        $container->add(ConnectionInterface::class, Connection::class);
    }
}
