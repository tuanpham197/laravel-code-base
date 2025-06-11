<?php

declare(strict_types=1);

namespace App\Traits;

use ReflectionClass;

trait UnsetPropertiesHandle
{
    protected function getUnsetProperties(): array
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties();
        $unsetProperties = [];

        foreach ($properties as $property) {
            $property->setAccessible(true);
            if ($property->getValue($this) === null && !$property->hasDefaultValue()) {
                $unsetProperties[] = $property->getName();
            }
        }

        return $unsetProperties;
    }
}
