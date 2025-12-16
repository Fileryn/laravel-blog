<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * Page d'accueil optimisée avec cache
     */
    public function index(): View
    {
        // Utilise le cache pour les derniers articles
        $latestArticles = Article::getLatest(3);

        return view('welcome', compact('latestArticles'));
    }
}
