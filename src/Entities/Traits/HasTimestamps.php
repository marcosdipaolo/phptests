<?php

namespace App\Entities\Traits;

use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;

trait HasTimestamps
{
    #[Column(name: "created_at", type: "datetime")]
    private DateTime $createdAt;

    #[Column(name: "updated_at", type: "datetime")]
    private DateTime $updatedAt;

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    #[PrePersist]
    #[PreUpdate]
    public function updatedTimestamps(): void
    {
        $this->initializeTimestamps();
        $this->setUpdatedAt(new DateTime());
    }

    public function initializeTimestamps(): void
    {
        $this->createdAt = $this->createdAt ?? new DateTime();
        $this->updatedAt = $this->updatedAt ?? new Datetime();
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
