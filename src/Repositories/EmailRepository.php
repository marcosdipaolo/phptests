<?php

namespace App\Repositories;

use App\Abstracts\Repositories\EmailAbstractRepository;
use App\Entities\Email;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

class EmailRepository extends BaseRepository implements EmailAbstractRepository
{
    public function __construct()
    {
        parent::__construct(Email::class);
    }

    /**
     * @param array $email
     * @return bool
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function saveEmail(array $email): bool
    {
        ['to' => $to, 'subject' => $subject, 'body' => $body] = $email;
        $email = new Email($to, $subject, $body);
        $this->em->persist($email);
        $this->em->flush();
        return true;
    }

    public function fetchAll(): array
    {
        return $this->findAll();
    }

    /**
     * @param string $id
     * @return void
     * @throws ORMException
     */
    public function removeEmail(string $id): void {
        $email = $this->find(intval($id));
        $this->em->remove($email);
        $this->em->flush();
    }
}
