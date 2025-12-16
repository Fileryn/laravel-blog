<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Categorie extends Model
{
    protected $fillable = ['nom', 'couleur'];

    /**
     * Une catégorie a plusieurs articles
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Scope: Catégories triées par nom
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('nom');
    }

    /**
     * Scope: Avec le nombre d'articles
     */
    public function scopeWithArticleCount($query)
    {
        return $query->withCount('articles');
    }

    /**
     * Vider le cache quand une catégorie est modifiée
     */
    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('global_stats');
            Cache::forget('all_categories');
        });

        static::deleted(function () {
            Cache::forget('global_stats');
            Cache::forget('all_categories');
        });
    }

    /**
     * Récupérer toutes les catégories (avec cache)
     */
    public static function getAllCached()
    {
        return Cache::remember('all_categories', 600, function () {
            return static::ordered()->withArticleCount()->get();
        });
    }
}
