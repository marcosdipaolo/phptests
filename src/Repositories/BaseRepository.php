<?php

namespace App\Repositories;

use App\Abstracts\ConnectionInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use MDP\Container\Exceptions\ContainerException;
use MDP\Container\Exceptions\NotFoundException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionException;

abstract class BaseRepository extends EntityRepository
{
    protected EntityManager $em;

    /**
     * @throws NotFoundExceptionInterface
     * @throws NotFoundException
     * @throws ContainerExceptionInterface
     * @throws ReflectionException
     * @throws ContainerException
     */
    public function __construct(string $class)
    {
        $conn = app()->get(ConnectionInterface::class);
        $this->em = $conn->getEntityManager();
        setUpLogger("base-repository")->info($this->em->getClassMetadata($class));
        parent::__construct($this->em, $this->em->getClassMetadata($class));
    }

    public function getEntityManager(): EntityManager
    {
        return $this->em;
    }
}
