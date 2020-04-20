<?php

namespace App\Controllers;

use App\Models\Mailer;

class MailController
{
    public function mail()
    {
        try {
            Mailer::send(
                request()->subject, getenv('MAIL_FROM'),
                request()->name, [request()->email], request()->body);
            return render('index', ['success' => 'Mail sent']);
        } catch(\Throwable $e) {
            return render('index', ['danger' => 'Something bad happened sending the email: ' . $e->getMessage()]);
        }
    }
}