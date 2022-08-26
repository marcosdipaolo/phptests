<?php

namespace App\Repositories;

use App\Abstracts\ConnectionInterface;
use App\Abstracts\Repositories\AuthenticationAbstractRepository;

class AuthenticationRepository extends BaseRepository implements AuthenticationAbstractRepository
{

    public function __construct(protected ConnectionInterface $conn)
    {
        parent::__construct($conn);
    }

    /**
     * @return bool
     */
    public function createFailedLoginAttempt(): bool
    {
        $ip = getRealIpAddr();
        $sql = /** @lang SQL */"INSERT INTO failed_login_attemps (`ip_address`) VALUES (:ip)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            ':ip' => $ip
        ]);
    }

    /**
     * @param string $ip
     * @return bool
     */
    public function exceededThrottle(string $ip): bool
    {
        $minutes = intval(env('THROTTLE_MINUTES_CONFIG'));
        $attemps = intval(env('THROTTLE_LOGIN_ATTEMPS'));
        $sql = /** @lang SQL */"SELECT * FROM `failed_login_attemps` WHERE `created_at` >= DATE_SUB(now(),interval {$minutes} minute) AND `ip_address` = '{$ip}';";
        $stmt = $this->connection->query($sql);
        return count($stmt->fetchAll()) > $attemps;
    }
}
