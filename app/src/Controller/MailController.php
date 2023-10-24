<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    #[Route('/mail', name: 'app_mail')]
    public function index(): Response
    {
        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
        ]);
    }

    #[Route(path: 'mail/new', name: 'app_mail_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {

    }

    #[Route(path: 'mail/{id}/show', name: 'show', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function show(Request $request, ): Response
    {


    }
}
