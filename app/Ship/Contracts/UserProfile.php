<?php

declare(strict_types=1);

namespace App\Ship\Contracts;

interface UserProfile
{
    public function getId(): int;
    public function getEmail(): string;
    public function getName(): string;
    public function getAvatar(): ?string;
    public function setName(string $name): self;
    public function setEmail(string $email): self;
    public function setPassword(string $password): self;
    public function setAvatar(?string $avatar): self;
    public function hasVerifiedEmail(): bool;
    public function markEmailAsVerified(): bool;
} 