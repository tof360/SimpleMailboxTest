<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait ReadTrait
{
    #[ORM\Column]
    private ?bool $read = false;

    public function isRead(): ?bool
    {
        return $this->read;
    }

    public function setRead(bool $read): self
    {
        $this->read = $read;

        return $this;
    }
}