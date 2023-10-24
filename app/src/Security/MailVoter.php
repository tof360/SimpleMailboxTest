<?php

namespace App\Security;

// src/Security/PostVoter.php
namespace App\Security;

use App\Entity\Mail;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class MailVoter extends Voter
{
    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';
    const NEW = 'new';
    const ARCHIVE = 'archive';
    const DELETE = 'delete';

    protected function supports(string $attribute, mixed $subject): bool
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT, self::NEW, self::ARCHIVE, self::DELETE ])) {
            return false;
        }

        if (!$subject instanceof Mail) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        /** @var Mail $mail */
        $mail = $subject;

        return match($attribute) {
            self::VIEW => $this->canView($mail, $user),
            self::EDIT => $this->canEdit($mail, $user),
            self::NEW => $this->canCreate($user),
            self::ARCHIVE => $this->canArchive($mail, $user),
            self::DELETE => $this->canDelete($mail, $user),
            default => throw new \LogicException('This code should not be reached!')
        };
    }

    private function canCreate(User $user): bool
    {
        return true;
    }
    private function canArchive(Mail $mail, User $user): bool
    {
        return true;
    }

    private function canDelete(Mail $mail, User $user): bool
    {
        return true;
    }

    private function canView(Mail $mail, User $user): bool
    {
        // if they can edit, they can view
        if ($this->canEdit($mail, $user)) {
            return true;
        }

        // the Post object could have, for example, a method `isPrivate()`
        return false;
    }

    private function canEdit(Mail $mail, User $user): bool
    {
        // this assumes that the Post object has a `getOwner()` method
        return $user === $mail->getOwner();
    }
}