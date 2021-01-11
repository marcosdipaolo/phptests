<?php

namespace App\Repositories;

use App\Abstracts\ConnectionInterface;
use PDO;

class BaseRepository
{
    /** @var PDO $connection  */
    protected $connection;
    
    public function __construct()
    {
        $connection = app()->get(ConnectionInterface::class);
        $this->connection = $connection->getPdo();
    }
}
