<?php

namespace App\Controllers;

class PageController
{
    public function index()
    {
        return render('index');
    }

    public function mail()
    {
        return render('mail');
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