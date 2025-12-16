<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Afficher tous les articles
     */
    public function index(): View
    {
        $articles = Article::with(['categorie', 'user', 'tags'])
            ->latest()
            ->paginate(2);
            
        return view('articles.index', compact('articles'));
    }

    /**
     * Formulaire de création
     */
    public function create(): View
    {
        $categories = Categorie::getAllCached();
        $tags = Tag::orderBy('nom')->get();
        return view('articles.create', compact('categories', 'tags'));
    }

    /**
     * Enregistrer un nouvel article
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string|min:10',
            'categorie_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ], [
            'titre.required' => 'Le titre est obligatoire.',
            'contenu.required' => 'Le contenu est obligatoire.',
            'contenu.min' => 'Le contenu doit faire au moins 10 caractères.',
            'image.image' => 'Le fichier doit être une image.',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ]);

        $data = $request->only(['titre', 'contenu', 'categorie_id']);
        $data['user_id'] = Auth::id();

        // Si une image est uploadée
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article = Article::create($data);

        // Synchroniser les tags
        $article->tags()->sync($request->tags ?? []);

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article créé avec succès !');
    }

    /**
     * Afficher un article
     */
    public function show(Article $article): View
    {
        $article->load(['user', 'tags', 'commentaires' => fn($q) => $q->recent()]);
        
        return view('articles.show', compact('article'));
    }

    /**
     * Formulaire de modification
     */
    public function edit(Article $article): View
    {
        $categories = Categorie::getAllCached();
        $tags = Tag::orderBy('nom')->get();
        return view('articles.edit', compact('article', 'categories', 'tags'));
    }

    /**
     * Mettre à jour un article
     */
    public function update(Request $request, Article $article): RedirectResponse
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string|min:10',
            'categorie_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ], [
            'titre.required' => 'Le titre est obligatoire.',
            'contenu.required' => 'Le contenu est obligatoire.',
            'contenu.min' => 'Le contenu doit faire au moins 10 caractères.',
            'image.image' => 'Le fichier doit être une image.',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ]);

        $data = $request->only(['titre', 'contenu', 'categorie_id']);

        // Si une nouvelle image est uploadée
        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        // Synchroniser les tags
        $article->tags()->sync($request->tags ?? []);

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article modifié avec succès !');
    }

    /**
     * Supprimer un article
     */
    public function destroy(Article $article): RedirectResponse
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article supprimé avec succès !');
    }
}
