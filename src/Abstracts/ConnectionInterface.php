<?php

namespace App\Abstracts;

interface ConnectionInterface
{
    public function getPdo(): \PDO;
}