<?php

namespace App\Repositories;
use App\Abstracts\ConnectionInterface;
use App\Abstracts\Repositories\FailedLoginAttemptAbstractRepository;
use App\Entities\FailedLoginAttemp;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

class FailedLoginAttemptRepository extends BaseRepository implements FailedLoginAttemptAbstractRepository
{
    public function __construct()
    {
        parent::__construct(FailedLoginAttemp::class);
    }

    /**
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function createFailedLoginAttempt(): void
    {
        $ip = getRealIpAddr();
        $failedLoginAttemp = new FailedLoginAttemp($ip);
        $this->em->persist($failedLoginAttemp);
        $this->em->flush();
    }

    /**
     * @param string $ip
     * @return bool
     */
    public function exceededThrottle(string $ip): bool
    {
        $minutes = intval(env('THROTTLE_MINUTES_CONFIG'));
        $attempts = intval(env('THROTTLE_LOGIN_ATTEMPS'));
        $qb = $this->em->createQueryBuilder();
        $qb
            ->select("fla")
            ->from(FailedLoginAttemp::class, "fla")
            ->where("fla.ipAddress = :ip")
            ->andWhere("fla.createdAt >= DATE_SUB(CURRENT_TIMESTAMP(), :minutes, 'minute')");
        $qb->setParameter("minutes", $minutes);
        $qb->setParameter("ip", $ip);
        $query = $qb->getQuery();
        return count($query->getResult()) > $attempts;
    }
}
