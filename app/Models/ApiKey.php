<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ApiKey extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'key',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($apiKey) {
            if (empty($apiKey->key)) {
                $apiKey->key = Str::random(32);
            }
            if (empty($apiKey->slug)) {
                $apiKey->slug = Str::slug($apiKey->name) . '-' . Str::random(6);
            }
        });
    }
}
