<?php

namespace App\Http\Controllers;

use App\Abstracts\Repositories\EmailAbstractRepository;
use MDP\Container\Exceptions\NotFoundException;
use Psr\Container\ContainerExceptionInterface;
use ReflectionException;

class PageController
{
    public function __construct(private readonly EmailAbstractRepository $emailRepository) {}

    /**
     * @throws NotFoundException
     * @throws ReflectionException
     * @throws ContainerExceptionInterface
     */
    public function index()
    {
        return render('index');
    }

    /**
     * @throws NotFoundException
     * @throws ReflectionException
     * @throws ContainerExceptionInterface
     */
    public function mail()
    {
        if (!auth()->user()) {
            redirect('/login');
        }
        $emails = $this->emailRepository->fetchAll();
        return render('mail', compact('emails'));
    }

    /**
     * @throws NotFoundException
     * @throws ReflectionException
     * @throws ContainerExceptionInterface
     */
    public function about()
    {
        return render('about');
    }

    /**
     * @throws NotFoundException
     * @throws ReflectionException
     * @throws ContainerExceptionInterface
     */
    public function error(int $code, string $message)
    {
        return render('error.errors', compact('code', 'message'));
    }
}
