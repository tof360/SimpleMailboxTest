<?php

namespace App\Twig;

use App\Entity\Mail;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    protected $entityManager;

    /**
     * @required
     */
    #[\Symfony\Contracts\Service\Attribute\Required]
    public function setEntityManager(EntityManagerInterface $entityManager): void
    {
        $this->entityManager = $entityManager;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('countUnreadMail', [$this, 'countUnreadMail']),
        ];
    }

    public function countUnreadMail(User $user): int
    {
        return $this->entityManager->getRepository(Mail::class)->findUnreadByUser($user->getId());
    }
}