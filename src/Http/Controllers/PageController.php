<?php

namespace App\Http\Controllers;

use App\Abstracts\Repositories\EmailAbstractRepository;

class PageController
{
    public function __construct(private readonly EmailAbstractRepository $emailRepository) {}

    public function index(): mixed
    {
        return render('index');
    }

    public function mail(): mixed
    {
        if (!auth()->user()) {
            redirect('/login');
        }
        $emails = $this->emailRepository->fetchAll();
        return render('mail', compact('emails'));
    }

    public function about(): mixed
    {
        return render('about');
    }

    /**
     * @param int $code
     * @param string $message
     * @return mixed|void
     */
    public function error(int $code, string $message)
    {
        /**
         * we don't use the render fn here, just
         * in case the error is thrown within
         */
        try {
            return require __DIR__ . "/../../Views/error/errors.view.php";
        } catch (\Throwable $e) {
            echo "<p>{$e->getMessage()}</p>";
            echo "<p>{$e->getTraceAsString()}</p>";
        }
    }
}
