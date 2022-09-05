<?php

namespace App\Repositories;
use App\Abstracts\ConnectionInterface;
use App\Abstracts\Repositories\FailedLoginAttemptAbstractRepository;
use App\Entities\FailedLoginAttemp;

class FailedLoginAttemptRepository extends BaseRepository implements FailedLoginAttemptAbstractRepository
{
    public function __construct()
    {
        parent::__construct(FailedLoginAttemp::class);
    }

    /**
     * @return bool
     * @throws \Doctrine\ORM\Exception\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createFailedLoginAttempt(): bool
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
        $attemps = intval(env('THROTTLE_LOGIN_ATTEMPS'));
        $qb = $this->em->createQueryBuilder();
        $qb
            ->select("fla")
            ->from(FailedLoginAttemp::class, "fla")
            ->where("ip_address = :ip")
            ->andWhere("created_at >= DATE_SUB(now(), :minutes, 'minute')");
        $qb->setParameter("minutes", $minutes);
        $qb->setParameter("ip", $ip);
        $query = $qb->getQuery();
        return count($query->getResult()) > $attemps;
//        $sql = /** @lang SQL */"SELECT * FROM `failed_login_attemps` WHERE
//                                         `created_at` >= DATE_SUB(now(),interval {$minutes} minute) AND
//                                         `ip_address` = '{$ip}';";
//        $stmt = $this->em->query($sql);
//        return count($stmt->fetchAll()) > $attemps;
    }
}
