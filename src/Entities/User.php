<?php

namespace App\Entities;

use App\Entities\Traits\HasTimestamps;
use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;
use MDP\Auth\Authenticatable;

#[Entity, HasLifecycleCallbacks]
#[Table("users")]
class User extends Authenticatable
{
    use HasTimestamps;

    #[Id, Column(type: 'integer'), GeneratedValue(strategy: "AUTO")]
    protected int | string $id;
    #[Column]
    protected string $username;
    #[Column]
    protected string $email;
    #[Column]
    protected string $password;
    #[OneToOne(mappedBy: 'user', targetEntity: Profile::class, cascade: ['all'])]
    private Profile $profile;
    #[Column(name: "verified_at", nullable: true)]
    private DateTime $verifiedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getVerifiedAt(): DateTime
    {
        return $this->verifiedAt;
    }

    /**
     * @param DateTime $verifiedAt
     * @return $this
     */
    public function setVerifiedAt(DateTime $verifiedAt): self
    {
        $this->verifiedAt = $verifiedAt;
        return $this;
    }

    /**
     * @return Profile
     */
    public function getProfile(): Profile
    {
        return $this->profile;
    }

    /**
     * @param Profile $profile
     * @return $this
     */
    public function setProfile(Profile $profile): self
    {
        $this->profile = $profile;
        return $this;
    }
}
