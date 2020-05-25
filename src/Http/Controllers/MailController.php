<?php

namespace App\Http\Controllers;

use App\Framework\Mailer;
use App\Repositories\EmailRepository;

class MailController
{
    /** @var EmailRepository $emailRepository */
    private $emailRepository;

    public function __construct(EmailRepository $emailRepository)
    {
        $this->emailRepository = $emailRepository;
    }

    public function mail()
    {
        try {
            $subject = request()->subject;
            $name = request()->name;
            $to = request()->email;
            $body = request()->body;
            if (
                $this->emailRepository
                    ->saveEmail(compact('to', 'name', 'body', 'subject'))
            ) {
                Mailer::send($subject, getenv('MAIL_FROM'),
                    $name, [$to], $body);
                return render('index', ['success' => 'Mail sent and stored']);
            }
            throw new \Exception('Unknown Error');
        } catch(\Throwable $e) {
            return render('index', [
                'danger' => 'Something bad happened sending the email. ' . $e->getMessage()
                ]
            );
        }
    }
}