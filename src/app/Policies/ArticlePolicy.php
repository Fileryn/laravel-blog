<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    /**
     * Tout le monde peut voir les articles
     */
    public function view(?User $user, Article $article): bool
    {
        return true;
    }

    /**
     * Seuls les utilisateurs connectés peuvent créer
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Admin peut tout modifier, sinon seulement l'auteur
     */
    public function update(User $user, Article $article): bool
    {
        return $user->isAdmin() || $user->id === $article->user_id;
    }

    /**
     * Admin peut tout supprimer, sinon seulement l'auteur
     */
    public function delete(User $user, Article $article): bool
    {
        return $user->isAdmin() || $user->id === $article->user_id;
    }
}
