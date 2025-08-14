<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class word extends Model
{
    protected $fillable = [
        'slug',
        'level',
        'image_url',
        'audio_url'
    ];

    /**
     * Get all of the translations for the Word
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(WordTranslation::class);
    }

    /**
     * Get all of the categories for the Word
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_word');
    }

    /**
     * Get all of the user_statuses for the Word
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userStatuses()
    {
        return $this->hasMany(UserWordStatus::class);
    }
}
