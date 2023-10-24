<?php

namespace App\Controller;

use App\Entity\Mail;
use App\Form\MailType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MailController extends AbstractController
{
    #[Route(path: 'mail/new', name: 'app_mail_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $mail = new Mail();
        $mail->setIsFrom($user);

        $form = $this->createForm(MailType::class, $mail);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password

            $entityManager->persist($mail);
            $entityManager->flush();

            $this->addFlash('success', 'The registration is successfull');

            return $this->redirectToRoute('app_default');
        }

        return $this->render('mail/new.html.twig', [
            'form' => $form,
        ]);

    }

    #[Route(path: 'mail/{id}/show', name: 'app_mail_show', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    #[IsGranted('view', 'mail')]
    public function show(Request $request, Mail $mail): Response
    {
        return $this->render('mail/view.html.twig', [
            'mail' => $mail,
        ]);
    }

    #[Route(path: 'mail/{id}/archive', name: 'app_mail_archive', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    #[IsGranted('archive', 'mail')]
    public function archive(Request $request, ): Response
    {

        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
        ]);


    }

    #[Route(path: 'mail/{id}/delete', name: 'app_mail_delete', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    #[IsGranted('delete', 'mail')]
    public function delete(Request $request): Response
    {

        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
        ]);


    }

    #[Route(path: 'mail/list', name: 'app_mail_list', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    #[IsGranted('list', 'mail')]
    public function list(Request $request): Response
    {

        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
        ]);


    }
}
