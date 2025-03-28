<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nickname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function like(Question $question): void
    {
        $this->votes()->updateOrCreate(
            ['question_id' => $question->id],
            [
                'like'   => 1,
                'unlike' => 0,
            ]
        );
    }

    public function unlike(Question $question): void
    {
        $this->votes()->updateOrCreate(
            ['question_id' => $question->id],
            [
                'like'   => 0,
                'unlike' => 1,
            ]
        );
    }
    /* >>>>>>>>>>>>>>>>>>>>>>>>>>>  VOTE  <<<<<<<<<<<<<<<<<<<<<<<<<<<<<< */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /* >>>>>>>>>>>>>>>>>>>>>>>>>>>  QUESTION  <<<<<<<<<<<<<<<<<<<<<<<<<<<<<< */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'created_by');
    }
}
