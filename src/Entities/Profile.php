<?php

namespace App\Entities;

use App\Entities\Traits\HasTimestamps;
use App\Entities\Traits\Identifiable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity, HasLifecycleCallbacks]
#[Table("profiles")]
class Profile
{
    use Identifiable, HasTimestamps;

    #[Column]
    private string $address;
    #[Column]
    private string $imagePath;
    #[OneToOne(inversedBy: 'profile', targetEntity: User::class)]
    private User $user;

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    /**
     * @param string $imagePath
     */
    public function setImagePath(string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}