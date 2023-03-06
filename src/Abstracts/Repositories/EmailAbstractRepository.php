<?php

namespace App\Abstracts\Repositories;

interface EmailAbstractRepository
{
    /**
     * @param array $email
     * @return bool
     */
    public function saveEmail(array $email): bool;

    /**
     * @return array
     */
    public function fetchAll(): array;

    /**
     * @param string $id
     * @return void
     */
    public function removeEmail(string $id): void;
}
