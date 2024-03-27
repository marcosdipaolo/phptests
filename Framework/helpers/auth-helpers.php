<?php

use App\Abstracts\Repositories\UserAbstractRepository;
use App\Entities\User;
use App\Repositories\UserRepository;
use MDP\Container\Exceptions\ContainerException;
use MDP\Container\Exceptions\NotFoundException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

if (!function_exists('getLoggedUser')) {
    /**
     * @throws NotFoundExceptionInterface
     * @throws NotFoundException
     * @throws ReflectionException
     * @throws ContainerExceptionInterface
     * @throws ContainerException
     */
    function getLoggedUser(): User | bool
    {
        $authenticatable = auth()->user();
        if (! $authenticatable?->getAuthenticatedUserId()) return false;
        /** @var UserRepository $repo */
        $repo = app()->get(UserAbstractRepository::class);
        return $repo->find($authenticatable?->getAuthenticatedUserId());
    }
}