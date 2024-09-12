<?php

namespace App\v1\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\v1\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasUuids, HasRolesAndPermissions;

    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }
}
