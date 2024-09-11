<?php

namespace App\v1\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PetType extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'title'
    ];

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }

    public function subTypes(): HasMany
    {
        return $this->hasMany(PetSubType::class);
    }
}
