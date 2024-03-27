<?php

namespace MDP\DB;

use App\Abstracts\ConnectionInterface;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;

class Connection implements ConnectionInterface
{
    private EntityManager $entityManager;
    private array $connectionData;

    private \Doctrine\DBAL\Connection $connection;

    /**
     * @throws ORMException
     */
    public function __construct()
    {
        $this->connectionData = [
            "dbname" => $_ENV['DB_NAME'],
            "user" => $_ENV['DB_USER'],
            "password" => $_ENV['DB_PASSWORD'],
            "host" => $_ENV['DB_HOST'],
            "port" => $_ENV['DB_PORT'] ?? 3306,
            "driver" => $_ENV["DB_DRIVER"],
            "pdo_driver" => $_ENV["PDO_DRIVER"],
        ];
        try {
            $this->connection = DriverManager::getConnection($this->connectionData);
            $config = ORMSetup::createAttributeMetadataConfiguration([__DIR__ . "/../src/Entities"]);
            $config->setAutoGenerateProxyClasses(true);
            $this->entityManager = new EntityManager(
                $this->connection,
                $config
            );
        } catch (Exception $e) {
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    public function getPDO(): \PDO
    {
        return new \PDO(
            "{$this->connectionData["pdo_driver"]}:host={$this->connectionData["host"]};" .
            "port={$this->connectionData["port"]};dbname={$this->connectionData["dbname"]}",
            $this->connectionData["user"],
            $this->connectionData["password"]
        );
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getDoctrineConnection(): \Doctrine\DBAL\Connection
    {
        return $this->connection;
    }
}
