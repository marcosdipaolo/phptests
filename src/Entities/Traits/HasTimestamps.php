<?php

namespace App\Entities\Traits;

use DateTime;
use Doctrine\ORM\Mapping\Column;

trait HasTimestamps
{
    #[Column(name: "created_at", type: "datetime")]
    private DateTime $createdAt;

    #[Column(name: "updated_at", type: "datetime")]
    private DateTime $updatedAt;

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
