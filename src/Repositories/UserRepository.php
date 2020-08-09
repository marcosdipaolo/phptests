<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * @param User $user
     * @return User
     */
    public function save(User $user)
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
    public function get(int $id)
    {
        $sql = /** @lang SQL */ "SELECT * FROM users WHERE id = {$id}";
        $stmt = $this->connection->query($sql);
        $array = $stmt->fetch();
        return (new User)->setUsername($array['username'])
            ->setEmail($array['email']);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email)
    {
        $sql = /** @lang SQL */"SELECT * FROM `users` WHERE `email` = '{$email}'";
        $stmt = $this->connection->query($sql);
        $data = $stmt->fetch();
        if ($data) {
            return (new User)->setEmail($data['email'])
                ->setUsername($data['username'])
                ->setPassword($data['password']);
        }
        return null;
    }
}