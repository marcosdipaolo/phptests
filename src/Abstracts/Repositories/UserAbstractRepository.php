<?php

namespace App\Abstracts\Repositories;

use App\Entities\User;

interface UserAbstractRepository
{
    public function get(int $id): User;
    public function findByEmail(string $email): ?User;
}