<?php

namespace App\Entities;

use App\Entities\Traits\HasTimestamps;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, HasLifecycleCallbacks]
#[Table("failed_login_attempts")]
class FailedLoginAttempt
{
    use HasTimestamps;

    #[Id, Column(type: 'integer'), GeneratedValue(strategy: "AUTO")]
    protected int | string $id;

    public function __construct(
        #[Column(name: "ip_address")]
        private readonly string $ipAddress
    ) {
    }

}