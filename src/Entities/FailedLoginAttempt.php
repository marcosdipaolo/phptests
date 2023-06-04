<?php

namespace App\Entities;

use App\Entities\Traits\HasTimestamps;
use App\Entities\Traits\Identifiable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Table;

#[Entity, HasLifecycleCallbacks]
#[Table("failed_login_attempts")]
class FailedLoginAttempt
{
    use Identifiable, HasTimestamps;

    public function __construct(
        #[Column(name: "ip_address")]
        private readonly string $ipAddress
    ) {
    }

}