<?php

namespace App\v1\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PetSubType extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'type_id',
        'title'
    ];

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(PetType::class);
    }
}
