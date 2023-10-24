<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait ReadTrait
{
    #[ORM\Column]
    private ?bool $isRead = false;

    public function isRead(): ?bool
    {
        return $this->isRead;
    }

    public function setRead(bool $isRead): self
    {
        $this->isRead = $isRead;

        return $this;
    }
}