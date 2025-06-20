<?php

declare(strict_types=1);

namespace App\Containers\Family\Enums;

enum FamilyMemberRoleEnum: string
{
    case OWNER = 'owner';
    case ADMIN = 'admin';
    case MEMBER = 'member';
    case VIEWER = 'viewer';

    public function label(): string
    {
        return match($this) {
            self::OWNER => 'Owner',
            self::ADMIN => 'Administrator',
            self::MEMBER => 'Member',
            self::VIEWER => 'Viewer',
        };
    }

    public function canManageMembers(): bool
    {
        return match($this) {
            self::OWNER, self::ADMIN => true,
            default => false,
        };
    }

    public function canManageFinances(): bool
    {
        return match($this) {
            self::OWNER, self::ADMIN, self::MEMBER => true,
            default => false,
        };
    }
} 