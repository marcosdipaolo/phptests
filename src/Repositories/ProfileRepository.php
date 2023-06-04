<?php

namespace App\Repositories;

use App\Abstracts\Repositories\ProfileAbstractRepository;
use App\Entities\Profile;
use App\Entities\User;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

class ProfileRepository extends BaseRepository implements ProfileAbstractRepository
{
    public function __construct()
    {
        parent::__construct(Profile::class);
    }

    /**
     * @param Profile $profile
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Profile $profile): void
    {
        /** @var User $user */
        $user = $this->em->merge(auth()->user());
        $profile->setUser($user);
        $this->em->persist($profile);
        $this->em->flush();
    }
}