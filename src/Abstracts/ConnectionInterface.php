<?php

namespace App\Abstracts;

use Doctrine\ORM\EntityManager;

interface ConnectionInterface
{
    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager;
}