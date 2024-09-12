<?php

namespace App\v1\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Permission extends Model
{
    use HasFactory, Notifiable, HasApiTokens, HasUuids;

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class,'roles_permissions');
    }
}
