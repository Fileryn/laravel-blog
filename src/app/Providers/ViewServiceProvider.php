<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     * Partage des données avec toutes les vues (avec cache)
     */
    public function boot(): void
    {
        // Partager les stats avec toutes les vues (cache de 5 minutes)
        View::composer('*', function ($view) {
            $stats = Cache::remember('global_stats', 300, function () {
                return [
                    'total_articles' => Article::count(),
                    'total_categories' => Categorie::count(),
                ];
            });
            
            $view->with('globalStats', $stats);
        });
    }
}
