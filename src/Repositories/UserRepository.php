<?php

namespace App\Repositories;

use App\Abstracts\Repositories\UserAbstractRepository;
use App\Entities\User;

class UserRepository extends BaseRepository implements UserAbstractRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    /**
     * @param int $id
     * @return User
     */
    public function get(int $id): User
    {
        return $this->find(User::class, $id);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder
            ->select("u")
            ->from(User::class, "u")
            ->where("u.email = :email");
        $queryBuilder->setParameter("email", $email);
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }
}
