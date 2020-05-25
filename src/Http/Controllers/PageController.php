<?php

namespace App\Http\Controllers;

use App\Repositories\EmailRepository;

class PageController
{
    /** @var EmailRepository $emailsRepository */
    private $emailRepository;

    public function __construct(EmailRepository $emailsRepository)
    {
        $this->emailRepository = $emailsRepository;
    }

    public function index()
    {
        return render('index');
    }

    public function mail()
    {
        $emails = $this->emailRepository->fetchAll();
        return render('mail', compact('emails'));
    }

    public function about()
    {
        return render('about');
    }

    public function error(int $code, string $message)
    {
        return render('error.errors', compact('code', 'message'));
    }
}