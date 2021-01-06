<?php

namespace App\Repositories;

use App\Models\User;
use PDOStatement;

class UserRepository extends BaseRepository
{
    /**
     * @param User $user
     * @return User
     */
    public function save(User $user): User
    {
        $sql = /** @lang SQL */ "INSERT INTO `users` (`username`, `email`, `password`) 
            VALUES (:username, :email, :password)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            ':username' => $user->getUsername(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword()
        ]);
        return $this->get($this->connection->lastInsertId());
    }

    /**
     * @param int $id
     * @return User
     */
    public function get(int $id): User
    {
        $sql = /** @lang SQL */ "SELECT * FROM users WHERE id = {$id}";

        /** @var PDOStatement $stmt */
        $stmt = $this->connection->query($sql);

        /** @var array $user */
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return (new User)
            ->setId($user['id'])
            ->setUsername($user['username'])
            ->setEmail($user['email']);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        $sql = /** @lang SQL */"SELECT * FROM `users` WHERE `email` = '{$email}'";
        $stmt = $this->connection->query($sql);
        $data = $stmt->fetch();
        if ($data) {
            return (new User)
                ->setId($data['id'])
                ->setEmail($data['email'])
                ->setUsername($data['username'])
                ->setPassword($data['password']);
        }
        return null;
    }
}
