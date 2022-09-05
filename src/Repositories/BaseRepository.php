<?php

namespace App\Repositories;

use App\Abstracts\ConnectionInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class BaseRepository extends EntityRepository
{
    protected EntityManager $em;
    
    public function __construct(string $class)
    {
        $conn = app()->get(ConnectionInterface::class);
        $this->em = $conn->getEntityManager();
        parent::__construct($this->em, $this->em->getClassMetadata($class));
    }
}
