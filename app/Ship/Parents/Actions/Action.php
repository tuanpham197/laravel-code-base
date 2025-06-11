<?php

declare(strict_types=1);

namespace App\Ship\Parents\Actions;

/**
 * Base Action Class
 *
 * All Container actions should extend this base action
 * Actions orchestrate business logic by coordinating multiple tasks
 */
abstract class Action
{
    /**
     * Run the action
     */
    abstract public function run(): mixed;
}
