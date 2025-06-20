<?php

declare(strict_types=1);

namespace App\Containers\Family\Models;

use App\Models\User;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFamilyRole extends Model
{
    protected $table = 'user_family_roles';
    protected $primaryKey = 'user_family_role_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'family_group_id',
        'role',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Get the user that owns the role.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the family group that the role belongs to.
     */
    public function familyGroup(): BelongsTo
    {
        return $this->belongsTo(FamilyGroup::class);
    }
} 