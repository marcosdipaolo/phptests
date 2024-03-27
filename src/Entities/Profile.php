<?php

namespace App\Entities;

use App\Entities\Traits\HasTimestamps;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity, HasLifecycleCallbacks]
#[Table("profiles")]
class Profile
{
    use HasTimestamps;

    #[Id, Column(type: 'integer'), GeneratedValue(strategy: "AUTO")]
    protected int | string $id;

    #[Column(nullable: true)]
    private string $address;
    #[Column(nullable: true)]
    private string $imagePath;
    #[OneToOne(inversedBy: 'profile', targetEntity: User::class)]
    #[JoinColumn(name: "user_id", referencedColumnName: "id")]
    private User $user;

    /**
     * @return string|null
     */
    public function getAddress(): string | null
    {
        return $this->address ?? NULL;
    }

    public function getId(): int|string
    {
        return $this->id;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|NULL
     */
    public function getImagePath(): string | NULL
    {
        return $this->imagePath ?? NULL;
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