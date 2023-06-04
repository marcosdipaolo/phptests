<?php

namespace App\Abstracts\Repositories;

use App\Entities\Profile;
use App\Entities\User;

interface ProfileAbstractRepository
{
    public function save(Profile $profile): void;
}