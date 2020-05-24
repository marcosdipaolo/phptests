<?php

namespace App\Repositories;

use Carbon\Carbon;

class EmailRepository extends BaseRepository
{
    public function saveEmail(array $email)
    {
        $sql = "INSERT INTO `emails` (`to`, `subject`, `body`, `created_at`) VALUES (:to, :subject, :body, :created_at)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            ':to' => $email['to'],
            ':subject' => $email['subject'],
            ':body' => $email['body'],
            ':created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}