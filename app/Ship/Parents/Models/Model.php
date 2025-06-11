<?php

declare(strict_types=1);

namespace App\Ship\Parents\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * Base Model Class
 *
 * All Container models should extend this base model
 */
abstract class Model extends EloquentModel
{
    // Common model functionality can be added here
}
