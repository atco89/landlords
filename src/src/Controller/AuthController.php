<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/auth')]
class AuthController extends AbstractController
{

    public function __construct(
        private readonly UserService $userService,
    )
    {
    }

    #[Route(path: '/sign-in', name: 'sign.in', methods: ['GET', 'POST'])]
    public function signIn(): Response
    {
        return $this->render('sign-in/index.html.twig');
    }

    #[Route(path: '/sign-up', name: 'sign.up', methods: ['GET', 'POST'])]
    public function signUp(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $this->userService->save($request);
        }
        return $this->render('sign-up/index.html.twig');
    }
}
