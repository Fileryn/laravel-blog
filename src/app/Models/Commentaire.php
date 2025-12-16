<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commentaire extends Model
{
    protected $fillable = ['auteur', 'email', 'contenu', 'article_id'];

    /**
     * Un commentaire appartient à un article
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Scope: Commentaires récents en premier
     */
    public function scopeRecent($query)
    {
        return $query->latest();
    }
}
