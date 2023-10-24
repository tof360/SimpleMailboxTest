<?php

namespace App\Entity;

use App\Entity\Interfaces\MailInterface;
use App\Entity\Traits\DraftTrait;
use App\Entity\Traits\ReadTrait;
use App\Repository\MailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: MailRepository::class)]
class Mail implements MailInterface
{
    use TimestampableEntity;
    use ReadTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $subject = null;

    #[ORM\Column]
    private ?bool $archived = false;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $body = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'mails')]
    private Collection $sendTo;

    #[ORM\ManyToOne(inversedBy: 'writtenMails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $isFrom = null;

    public function __construct()
    {
        $this->sendTo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function isArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getSendTo(): Collection
    {
        return $this->sendTo;
    }

    public function addSendTo(User $sendTo): self
    {
        if (!$this->sendTo->contains($sendTo)) {
            $this->sendTo->add($sendTo);
        }

        return $this;
    }

    public function removeSendTo(User $sendTo): self
    {
        $this->sendTo->removeElement($sendTo);

        return $this;
    }

    public function getIsFrom(): ?User
    {
        return $this->isFrom;
    }

    public function setIsFrom(?User $isFrom): static
    {
        $this->isFrom = $isFrom;

        return $this;
    }
}
