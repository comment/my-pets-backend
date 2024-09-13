<?php

namespace App\v1\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pet extends Model
{
    use HasFactory, Notifiable, HasApiTokens, HasUuids;

    protected $fillable = [
        'user_id',
        'type',
        'sub_type',
        'identifier',
        'nickname',
        'date_of_birth',
        'about',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(PetType::class);
    }

    public function subType(): BelongsTo
    {
        return $this->belongsTo(PetSubType::class);
    }
}
