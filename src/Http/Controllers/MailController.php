<?php

namespace App\Http\Controllers;

use App\Abstracts\Repositories\EmailAbstractRepository;
use App\Framework\Mailer;
use App\Models\User;

class MailController
{
    /** @var EmailAbstractRepository $emailRepository */
    private $emailRepository;

    public function __construct()
    {
        $this->emailRepository = app()->get(EmailAbstractRepository::class);
    }

    public function mail()
    {
        /** @var User | null $user */
        if (!$loggedUser = auth()->user()) {
            return redirect('/login');
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
                Mailer::send(
                    $subject,
                    $loggedUser->getEmail(),
                    $name,
                    [$to],
                    $body
                );
                return redirect('/mail', ['success' => 'Mail sent and stored']);
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
