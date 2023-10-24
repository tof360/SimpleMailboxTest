<?php

namespace App\Entity\Interfaces;

interface MailInterface
{
    public function getId(): ?int;

    public function getSubject(): ?string;

    public function setSubject(string $subject): self;

    public function getBody(): ?string;

    public function setBody(?string $body): self;
}