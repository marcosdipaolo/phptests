<?php

namespace App\Abstracts;

use Doctrine\ORM\EntityManagerInterface;
use PDO;

interface ConnectionInterface
{
    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface;

    /**
     * @return PDO
     */
    public function getPDO(): PDO;
}
