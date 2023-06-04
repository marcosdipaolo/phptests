<?php

namespace App\Entities\Traits;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

trait Identifiable
{
    #[Id, Column, GeneratedValue]
    private int $id;
}