<?php

namespace App\Repositories;

use App\Models\User;
use DB\Connection;

class AuthenticationRepository extends BaseRepository
{
    /** @var UserRepository $userRepository */
    private $userRepository;

    public function __construct(Connection $connection, UserRepository $userRepository)
    {
        parent::__construct($connection);
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $email
     * @param string $password
     * @return User|bool
     */
    public function authenticate(string $email, string $password)
    {
        $user = $this->userRepository->findByEmail($email);
        if ($user) {
            $authenticated = password_verify($password, $user->getPassword());
            if ($authenticated) {
                return $user;
            }
            return false;
        }
        return false;
    }

    public function createFailedLoginAttemp()
    {
        $ip = getRealIpAddr();
        $sql = /** @lang SQL */"INSERT INTO failed_login_attemps (`ip_address`) VALUES (:ip)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            ':ip' => $ip
        ]);
    }

    public function exceededThrottle(string $ip)
    {
        $minutes = intval(env('THROTTLE_MINUTES_CONFIG'));
        $attemps = intval(env('THROTTLE_LOGIN_ATTEMPS'));
        $sql = /** @lang SQL */"SELECT * FROM `failed_login_attemps` WHERE `created_at` >= DATE_SUB(now(),interval {$minutes} minute) AND `ip_address` = '{$ip}';";
        $stmt = $this->connection->query($sql);
        return count($stmt->fetchAll()) > $attemps;
    }
}
