<?php

namespace App\Repositories;

use App\Abstracts\Repositories\ProfileAbstractRepository;
use App\Entities\Profile;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use MDP\Container\Exceptions\ContainerException;
use MDP\Container\Exceptions\NotFoundException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionException;

class ProfileRepository extends BaseRepository implements ProfileAbstractRepository
{
    public function __construct()
    {
        parent::__construct(Profile::class);
    }

    /**
     * @param Profile $profile
     * @return void
     * @throws ContainerException
     * @throws ContainerExceptionInterface
     * @throws NotFoundException
     * @throws NotFoundExceptionInterface
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     */
    public function save(Profile $profile): void
    {
        $user = getLoggedUser();
        $profile->setUser($user);
        $user->setProfile($profile);
        $this->em->merge($user);
        $this->em->flush();
    }
}