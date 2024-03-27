<?php

namespace App\Repositories;

use App\Abstracts\Repositories\FailedLoginAttemptAbstractRepository;
use App\Entities\FailedLoginAttempt;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

class FailedLoginAttemptRepository extends BaseRepository implements FailedLoginAttemptAbstractRepository
{
    public function __construct()
    {
        parent::__construct(FailedLoginAttempt::class);
    }

    /**
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function createFailedLoginAttempt(): void
    {
        $ip = getRealIpAddr();
        $failedLoginAttempt = new FailedLoginAttempt($ip);
        $this->em->persist($failedLoginAttempt);
        $this->em->flush();
    }

    /**
     * @param string $ip
     * @return bool
     */
    public function exceededThrottle(string $ip): bool
    {
        $logger = setUpLogger('failedLoginAttempts');
        $minutes = intval(env('THROTTLE_MINUTES_CONFIG', 1));
        $attempts = intval(env('THROTTLE_LOGIN_ATTEMPS', 3));
        $qb = $this->em->createQueryBuilder();
        $qb
            ->select("fla")
            ->from(FailedLoginAttempt::class, "fla")
            ->where("fla.ipAddress = :ip")
            ->andWhere("fla.createdAt >= DATE_SUB(CURRENT_TIMESTAMP(), :minutes, 'minute')");
        $qb->setParameter("minutes", $minutes);
        $qb->setParameter("ip", $ip);
        $query = $qb->getQuery();
        return count($query->getResult()) >= ($attempts - 1);
    }
}
