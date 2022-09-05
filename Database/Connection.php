<?php

namespace DB;

use App\Abstracts\ConnectionInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;
use PDO;

class Connection implements ConnectionInterface
{
    private EntityManager $entityManager;

    /**
     * @throws ORMException
     */
    public function __construct()
    {
        $this->entityManager = EntityManager::create(
            [
                "dbname" => $_ENV['DB_NAME'],
                "user" => $_ENV['DB_USER'],
                "password" => $_ENV['DB_PASSWORD'],
                "host" => $_ENV['DB_HOST'],
                "port" => $_ENV['DB_PORT'],
                "driver" => $_ENV["DB_DRIVER"]
            ],
            ORMSetup::createAttributeMetadataConfiguration(["../src/Entities"])
        );
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }
}
