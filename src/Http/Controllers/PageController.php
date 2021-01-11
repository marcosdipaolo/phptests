<?php

namespace App\Http\Controllers;

use App\Abstracts\Repositories\EmailAbstractRepository;

class PageController
{
    /** @var EmailAbstractRepository $emailsRepository */
    private $emailRepository;

    public function __construct()
    {
        $this->emailRepository = app()->get(EmailAbstractRepository::class);
    }

    public function index()
    {
        return render('index');
    }

    public function mail()
    {
        if (!auth()->user()) {
            redirect('/login');
        }
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
