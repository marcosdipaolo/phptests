<?php

namespace App\Repositories;

use App\Database\Connection;

class BaseRepository 
{
    protected $connection;
    
    public function __construct()
    {
        $this->connection = (new Connection)->getPdo();
    }
}