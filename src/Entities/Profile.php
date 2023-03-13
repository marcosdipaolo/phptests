<?php

namespace App\Entities;

use App\Entities\Traits\HasTimestamps;
use App\Entities\Traits\Identifiable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table("Profile")]
class Profile
{
    use Identifiable, HasTimestamps;

    #[Column]
    private string $address;
    #[Column]
    private string $imagePath;

    #[OneToOne(inversedBy: 'profile', targetEntity: User::class)]
    #[JoinColumn(name: 'customer_id', referencedColumnName: 'id')]
    private User $user;
}