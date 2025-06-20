<?php

declare(strict_types=1);

namespace App\Containers\Family\Tasks;

use App\Containers\Family\Enums\FamilyMemberRoleEnum;
use App\Containers\Family\Models\FamilyMember;
use App\Ship\Parents\Tasks\Task;
use App\Traits\PropertyFillable;
use Carbon\Carbon;

class CreateFamilyMemberTask extends Task
{
    use PropertyFillable;

    private int $familyGroupId;
    private int $userId;
    private FamilyMemberRoleEnum $role;
    private string $status;
    private ?Carbon $joinedAt = null;

    public function run(array $data): FamilyMember
    {
        $this->fillProperties($data);

        if (!$this->joinedAt) {
            $this->joinedAt = now();
        }

        return FamilyMember::create([
            'family_group_id' => $this->familyGroupId,
            'user_id' => $this->userId,
            'role' => $this->role->value,
            'status' => $this->status,
            'joined_at' => $this->joinedAt,
        ]);
    }
} 