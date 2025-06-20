<?php

declare(strict_types=1);

namespace App\Containers\Family\Models;

use App\Models\User;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FamilyGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'currency',
        'timezone',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(FamilyMember::class);
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'family_members')
            ->withPivot(['role', 'status'])
            ->withTimestamps();
    }
} 