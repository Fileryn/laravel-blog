<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CommentaireController extends Controller
{
    /**
     * Enregistrer un nouveau commentaire
     */
    public function store(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'auteur' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'contenu' => 'required|string|min:3',
        ], [
            'auteur.required' => 'Ton nom est obligatoire.',
            'email.email' => 'L\'email n\'est pas valide.',
            'contenu.required' => 'Le commentaire ne peut pas être vide.',
            'contenu.min' => 'Le commentaire doit faire au moins 3 caractères.',
        ]);

        $article->commentaires()->create($validated);

        return back()->with('success', 'Commentaire ajouté !');
    }

    /**
     * Supprimer un commentaire
     */
    public function destroy(Commentaire $commentaire): RedirectResponse
    {
        $commentaire->delete();

        return back()->with('success', 'Commentaire supprimé !');
    }
}
