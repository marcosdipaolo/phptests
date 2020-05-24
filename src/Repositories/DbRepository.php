<?php

namespace App\Repositories;

class DbRepository extends BaseRepository
{
    const TABLES = [
        'emails'
    ];

    public function migrate()
    {
        
    }

    public function tableExists(string $table)
    {

    }
}