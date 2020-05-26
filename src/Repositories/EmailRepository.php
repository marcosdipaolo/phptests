<?php

namespace App\Repositories;

use App\Abstracts\Repositories\EmailAbstractRepository;
use Carbon\Carbon;

class EmailRepository extends BaseRepository implements EmailAbstractRepository
{
    public function saveEmail(array $email)
    {
        $sql = /** @lang SQL */ "INSERT INTO `emails` (`to`, `subject`, `body`, `created_at`) VALUES (:to, :subject, :body, :created_at)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            ':to' => $email['to'],
            ':subject' => $email['subject'],
            ':body' => $email['body'],
            ':created_at' => Carbon::now()->toDateTimeString()
        ]);
    }

    public function fetchAll()
    {
        $sql = /** @lang SQL */ "SELECT * FROM emails";
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}