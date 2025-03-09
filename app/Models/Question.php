<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Eloquent\{Model, Prunable, SoftDeletes};

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Prunable;

    protected $fillable = [
        'title',
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

    public function prunable(): Builder
    {
        return static::where('deleted_at', '<=', now()->subMonths(1));
    }

}
