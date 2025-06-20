<?php

declare(strict_types=1);

namespace App\Containers\Family\Actions;

use App\Ship\Contracts\UserProfile;
use App\Ship\Parents\Actions\Action;
use App\Containers\Family\Models\FamilyGroup;
use App\Traits\PropertyFillable;

class CreateFamilyGroupAction extends Action
{
    use PropertyFillable;

    private array $familyGroupData;
    private UserProfile $user;

    public function run(): FamilyGroup
    {
        return FamilyGroup::create([
            ...$this->familyGroupData,
            'created_by' => $this->user->getId(),
        ]);
    }
} 