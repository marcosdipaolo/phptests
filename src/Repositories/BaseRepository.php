<?php

namespace App\Repositories;

use App\Abstracts\ConnectionInterface;
use PDO;

class BaseRepository
{
    protected \PDO $connection;
    
    public function __construct(protected ConnectionInterface $conn)
    {
        $this->connection = $conn->getPdo();
    }
}
