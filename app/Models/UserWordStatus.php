<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWordStatus extends Model
{
    protected $fillable = [
        'user_id',
        'word_id',
        'familiarity_star',
        'correct_count',
        'wrong_count',
        'last_practiced_at'
    ];

    /**
     * Get the user that owns the UserWordStatus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the word that owns the UserWordStatus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
