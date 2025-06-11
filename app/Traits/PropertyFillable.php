<?php

declare(strict_types=1);

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ReflectionProperty;

trait PropertyFillable
{
    use UnsetPropertiesHandle;

    public function fillProperties(array|Collection $data): self
    {
        foreach ($data as $key => $value) {
            $camlKey = Str::camel($key);
            $property = null;
            if (property_exists($this, $key)) {
                $property = $key;
            } elseif (property_exists($this, $camlKey)) {
                $property = $camlKey;
            }

            if ($property) {
                $rp = new ReflectionProperty($this, $property);
                if ($rp->getType()->getName() === Carbon::class) {
                    $this->$property = $value ? Carbon::parse($value) : null;
                } else {
                    $this->$property = $value;
                }
            }
        }

        $unsetProperties = $this->getUnsetProperties();
        if (!empty($unsetProperties)) {
            throw new \InvalidArgumentException('Properties [' . implode(', ', $unsetProperties) . '] must be set');
        }

        return $this;
    }
}
