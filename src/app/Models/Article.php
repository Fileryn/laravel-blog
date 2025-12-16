<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Article extends Model
{
    protected $fillable = ['titre', 'contenu', 'image', 'user_id', 'categorie_id'];

    /**
     * Les relations à toujours charger (évite les requêtes N+1)
     */
    protected $with = ['categorie'];

    /**
     * Un article appartient à un utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un article appartient à une catégorie
     */
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    /**
     * Un article a plusieurs commentaires
     */
    public function commentaires(): HasMany
    {
        return $this->hasMany(Commentaire::class);
    }

    /**
     * Un article peut avoir plusieurs tags (Many-to-Many)
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Scope: Articles récents
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->latest()->take($limit);
    }

    /**
     * Scope: Articles avec toutes les relations
     */
    public function scopeWithAll($query)
    {
        return $query->with(['user', 'categorie', 'commentaires', 'tags']);
    }

    /**
     * Vider le cache quand un article est modifié
     */
    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('global_stats');
            Cache::forget('latest_articles');
        });

        static::deleted(function () {
            Cache::forget('global_stats');
            Cache::forget('latest_articles');
        });
    }

    /**
     * Récupérer les derniers articles (avec cache)
     */
    public static function getLatest($limit = 5)
    {
        return Cache::remember('latest_articles', 300, function () use ($limit) {
            return static::with(['categorie', 'user'])
                ->latest()
                ->take($limit)
                ->get();
        });
    }
}
