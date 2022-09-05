<?php

namespace App\Repositories;

use App\Abstracts\ConnectionInterface;
use App\Abstracts\Repositories\EmailAbstractRepository;
use App\Entities\Email;

class EmailRepository extends BaseRepository implements EmailAbstractRepository
{
    public function __construct()
    {
        parent::__construct(Email::class);
    }

    /**
     * @param array $email
     * @return bool
     * @throws \Doctrine\ORM\Exception\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveEmail(array $email): bool
    {
        [$to, $subject, $body] = $email;
        $email = new Email($to, $subject, $body);
        $this->em->persist($email);
        $this->em->flush();

//        $sql = /** @lang SQL */ "INSERT INTO `emails` (`to`, `subject`, `body`, `created_at`) VALUES (:to, :subject, :body, :created_at)";
//        $stmt = $this->connection->prepare($sql);
//        return $stmt->execute([
//            ':to' => $email['to'],
//            ':subject' => $email['subject'],
//            ':body' => $email['body'],
//            ':created_at' => Carbon::now()->toDateTimeString()
//        ]);
    }

    public function fetchAll(): array
    {
        return $this->findAll();
    }
}
