<?php

namespace App\Abstracts\Repositories;

interface EmailAbstractRepository
{
    /**
     * @param array $email
     * @return bool
     */
    public function saveEmail(array $email);

    /**
     * @return array
     */
    public function fetchAll();
}