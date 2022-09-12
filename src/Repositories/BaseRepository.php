<?php

namespace App\Repositories;

use App\Abstracts\ConnectionInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use MDP\Container\Exceptions\ContainerException;
use MDP\Container\Exceptions\NotFoundException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

abstract class BaseRepository extends EntityRepository
{
    protected EntityManager $em;

    /**
     * @throws NotFoundExceptionInterface
     * @throws NotFoundException
     * @throws ContainerExceptionInterface
     * @throws \ReflectionException
     * @throws ContainerException
     */
    public function __construct(string $class)
    {
        $conn = app()->get(ConnectionInterface::class);
        $this->em = $conn->getEntityManager();
        parent::__construct($this->em, $this->em->getClassMetadata($class));
    }
}
