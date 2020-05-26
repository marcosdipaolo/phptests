<?php

namespace App\Repositories;

use DB\Connection;
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