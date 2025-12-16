<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Http\Requests\CategorieRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategorieController extends Controller
{
    /**
     * Afficher toutes les catégories
     */
    public function index(): View
    {
        $categories = Categorie::withArticleCount()
            ->ordered()
            ->get();
            
        return view('categories.index', compact('categories'));
    }

    /**
     * Formulaire de création
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Enregistrer une nouvelle catégorie
     */
    public function store(CategorieRequest $request): RedirectResponse
    {
        Categorie::create($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie créée avec succès !');
    }

    /**
     * Afficher une catégorie et ses articles
     */
    public function show(Categorie $categorie): View
    {
        $articles = $categorie->articles()
            ->with('user')
            ->latest()
            ->get();
            
        return view('categories.show', compact('categorie', 'articles'));
    }

    /**
     * Formulaire de modification
     */
    public function edit(Categorie $categorie): View
    {
        return view('categories.edit', compact('categorie'));
    }

    /**
     * Mettre à jour une catégorie
     */
    public function update(CategorieRequest $request, Categorie $categorie): RedirectResponse
    {
        $categorie->update($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie modifiée avec succès !');
    }

    /**
     * Supprimer une catégorie
     */
    public function destroy(Categorie $categorie): RedirectResponse
    {
        $categorie->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès !');
    }
}
