<?php

namespace App\Repositories;

use App\Abstracts\Repositories\UserAbstractRepository;
use App\Entities\User;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\OptimisticLockException;

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
     * @throws NoResultException
     * @throws NonUniqueResultException
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
        return $query->getSingleResult();
    }

    /**
     * @param User $user
     * @return User
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(User $user): User
    {
        $this->em->persist($user);
        $this->em->flush();
        return $user;
    }
}
