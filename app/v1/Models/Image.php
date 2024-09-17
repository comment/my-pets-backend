<?php

namespace App\v1\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Image extends Model
{
    use HasFactory, Notifiable, HasApiTokens, HasUuids;

    protected $fillable = [
        'image_type',
        'filename',
        'mime_type',
        'size',
        'path',
        'user_id',
        'pet_id',
    ];

}
