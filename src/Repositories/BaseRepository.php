<?php

namespace App\Repositories;

use App\Database\Connection;
use PDO;

class BaseRepository 
{
    /** @var PDO $connection  */
    protected $connection;
    
    public function __construct(Connection $connection)
    {
        $this->connection = $connection->getPdo();
    }
}