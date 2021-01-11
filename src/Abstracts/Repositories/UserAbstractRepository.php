<?php

namespace App\Abstracts\Repositories;

use App\Models\User;

interface UserAbstractRepository
{
    public function save(User $user): User;
    public function get(int $id): User;
    public function findByEmail(string $email): ?User;
}