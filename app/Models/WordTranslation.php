<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordTranslation extends Model
{
    protected $fillable = [
        'word_id',
        'language_code',
        'word_text',
        'definition',
        'example_sentence'
    ];

    /**
     * Get the word that owns the WordTranslation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
