<?php

namespace App\Http\Controllers;

use App\Abstracts\Repositories\EmailAbstractRepository;
use MDP\Mailer\Mailer;
use App\Entities\User;

class MailController
{

    public function __construct(private EmailAbstractRepository $emailRepository) {}

    public function mail()
    {
        /** @var User | null $user */
        if (!$loggedUser = auth()->user()) {
            redirect('/login');
        }
        try {
            $subject = request('subject');
            $name = request('name');
            $to = request('email');
            $body = request('body');
            if (
            $this->emailRepository
                ->saveEmail(compact('to', 'name', 'body', 'subject'))
            ) {
                mailer()->send(
                    $subject,
                    $loggedUser->getEmail(),
                    [$to],
                    $body
                );
                redirect('/mail', ['success' => 'Mail sent and stored']);
            }
            throw new \Exception('Unknown Error');
        } catch (\Throwable $e) {
            return render(
                'index',
                [
                    'danger' => 'Something bad happened sending the email. ' . $e->getMessage()
                ]
            );
        }
    }

}
