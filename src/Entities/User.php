<?php

namespace App\Entities;

use App\Entities\Traits\HasTimestamps;
use App\Entities\Traits\Identifiable;
use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;
use MDP\Auth\Authenticatable;

#[Entity, HasLifecycleCallbacks]
#[Table("users")]
class User implements Authenticatable
{
    use Identifiable, HasTimestamps;

    #[Column]
    private string $username;
    #[Column]
    private string $email;
    #[Column]
    private string $password;
    #[OneToOne(mappedBy: 'user', targetEntity: Profile::class)]
    private Profile $profile;
    #[Column(name: "verified_at", nullable: true)]
    private DateTime $verifiedAt;

    /**
     * @return string
     */
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

    /**
     * @return string
     */
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

    /**
     * @return string
     */
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     */
    public function setVerifiedAt(DateTime $verifiedAt): void
    {
        $this->verifiedAt = $verifiedAt;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
}
