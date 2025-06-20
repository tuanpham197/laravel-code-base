<?php

declare(strict_types=1);

namespace App\Containers\Family\UI\API\Controllers;

use App\Containers\Family\Actions\CreateFamilyGroupAction;
use App\Containers\Family\UI\API\Requests\CreateFamilyGroupRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class FamilyGroupController extends ApiController
{
    public function __construct(
        private readonly CreateFamilyGroupAction $createFamilyGroupAction,
    ) {}

    /**
     * Create a new family group
     */
    public function store(CreateFamilyGroupRequest $request): JsonResponse
    {
        $familyGroup = $this->createFamilyGroupAction
            ->fillProperties([
                'familyGroupData' => $request->validated(),
                'user' => $request->user(),
            ])
            ->run();

        return $this->created(
            data: $familyGroup->toArray(),
            message: 'Family group created successfully',
        );
    }
} 