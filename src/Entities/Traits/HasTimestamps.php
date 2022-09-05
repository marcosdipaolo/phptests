<?php

namespace App\Entities\Traits;

use DateTime;
use Doctrine\ORM\Mapping\Column;

trait HasTimestamps
{
    #[Column(name: "created_at")]
    private DateTime $createdAt;

    #[Column(name: "updated_at")]
    private DateTime $updatedAt;
}
