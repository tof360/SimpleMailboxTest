<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait DraftTrait
{
    #[ORM\Column]
    private ?bool $draft = false;

    public function isDraft(): ?bool
    {
        return $this->draft;
    }

    public function setDraft(bool $draft): self
    {
        $this->draft = $draft;

        return $this;
    }
}