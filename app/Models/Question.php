<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'draft',
        'created_by',
    ];

    protected $casts = [
        'draft' => 'boolean',
    ];

    /* >>>>>>>>>>>>>>>>>>> VOTE <<<<<<<<<<<<<<<<<<<< */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /* >>>>>>>>>>>>>>>>>>> USER <<<<<<<<<<<<<<<<<<<< */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
