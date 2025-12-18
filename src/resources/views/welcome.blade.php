@extends('layouts.app')

@section('title', 'Accueil - Laravel Blog')

@section('content')
<div class="text-center" style="padding: 40px 0;">
    <h1 style="font-size: 3.5rem; margin-bottom: 20px;">Bienvenue sur Laravel Blog ! 🚀</h1>
    <p style="font-size: 1.3rem; opacity: 0.9; margin-bottom: 40px;">
        Un blog moderne créé avec Laravel 12 et PHP 8
    </p>

    <div class="d-flex justify-center gap-2 flex-wrap">
        <a href="{{ route('articles.index') }}" class="btn btn-primary" style="padding: 15px 30px; font-size: 1.1rem;">
            📝 Voir les Articles
        </a>
        <a href="{{ route('categories.index') }}" class="btn" style="padding: 15px 30px; font-size: 1.1rem;">
            🏷️ Voir les Catégories
        </a>
    </div>
</div>

<!-- Stats rapides -->
<div class="d-flex justify-center gap-2 flex-wrap mb-3">
    <div class="card text-center" style="min-width: 150px;">
        <div style="font-size: 2.5rem; font-weight: bold;">{{ \App\Models\Article::count() }}</div>
        <div class="text-muted">Articles</div>
    </div>
    <div class="card text-center" style="min-width: 150px;">
        <div style="font-size: 2.5rem; font-weight: bold;">{{ \App\Models\Categorie::count() }}</div>
        <div class="text-muted">Catégories</div>
    </div>
    <div class="card text-center" style="min-width: 150px;">
        <div style="font-size: 2.5rem; font-weight: bold;">{{ \App\Models\User::count() }}</div>
        <div class="text-muted">Utilisateurs</div>
    </div>
    <div class="card text-center" style="min-width: 150px;">
        <div style="font-size: 2.5rem; font-weight: bold;">{{ \App\Models\Commentaire::count() }}</div>
        <div class="text-muted">Commentaires</div>
    </div>
</div>

<!-- Derniers articles -->
@if($latestArticles->count() > 0)
<div class="mb-3">
    <h2 class="text-center mb-2">📰 Derniers Articles</h2>
    <div class="d-flex flex-wrap gap-2 justify-center">
        @foreach($latestArticles as $article)
        <div class="card" style="flex: 1; min-width: 280px; max-width: 350px;">
            @if($article->image)
                <div style="margin: -25px -25px 15px -25px; border-radius: 15px 15px 0 0; overflow: hidden; height: 150px;">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->titre }}" 
                         style="width: 100%; height: 100%; object-fit: cover;"
                         onerror="this.parentElement.style.display='none';">
                </div>
            @endif
            <div class="d-flex align-center gap-1 mb-1">
                @if($article->categorie)
                    <span class="badge" style="background-color: {{ $article->categorie->couleur }};">
                        {{ $article->categorie->nom }}
                    </span>
                @endif
                @foreach($article->tags->take(2) as $tag)
                    <span class="badge" style="background-color: {{ $tag->couleur }}; font-size: 0.7rem;">
                        {{ $tag->nom }}
                    </span>
                @endforeach
            </div>
            <h3 class="mb-1">{{ $article->titre }}</h3>
            <p class="text-muted mb-1" style="font-size: 0.85rem;">
                Par {{ $article->user->name ?? 'Anonyme' }} • {{ $article->created_at->diffForHumans() }}
            </p>
            <p class="text-muted mb-2">{{ Str::limit($article->contenu, 100) }}</p>
            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm">Lire la suite →</a>
        </div>
        @endforeach
    </div>
    <div class="text-center mt-2">
        <a href="{{ route('articles.index') }}" class="btn">Voir tous les articles →</a>
    </div>
</div>
@endif

<!-- Tags populaires -->
@php
    $tags = \App\Models\Tag::withCount('articles')->orderBy('articles_count', 'desc')->take(10)->get();
@endphp
@if($tags->count() > 0)
<div class="card text-center mb-3">
    <h3 class="mb-2">🏷️ Tags populaires</h3>
    <div class="d-flex justify-center gap-1 flex-wrap">
        @foreach($tags as $tag)
            <span class="badge" style="background-color: {{ $tag->couleur }}; padding: 8px 15px; font-size: 0.9rem;">
                {{ $tag->nom }} ({{ $tag->articles_count }})
            </span>
        @endforeach
    </div>
</div>
@endif

<!-- Message pour les visiteurs -->
@guest
<div class="card text-center" style="max-width: 500px; margin: 0 auto;">
    <h3 class="mb-1">👋 Nouveau ici ?</h3>
    <p class="text-muted mb-2">Inscris-toi pour créer et gérer tes propres articles !</p>
    <div class="d-flex justify-center gap-1">
        <a href="{{ route('register') }}" class="btn btn-success">Créer un compte</a>
        <a href="{{ route('login') }}" class="btn">Se connecter</a>
    </div>
</div>
@endguest

<!-- Message pour les utilisateurs connectés -->
@auth
<div class="card text-center" style="max-width: 500px; margin: 0 auto;">
    <h3 class="mb-1">🎉 Content de te revoir, {{ Auth::user()->name }} !</h3>
    <p class="text-muted mb-2">Que veux-tu faire aujourd'hui ?</p>
    <div class="d-flex justify-center gap-1 flex-wrap">
        <a href="{{ route('articles.create') }}" class="btn btn-success">+ Nouvel Article</a>
        <a href="{{ route('categories.create') }}" class="btn">+ Nouvelle Catégorie</a>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">📊 Mon Dashboard</a>
    </div>
</div>
@endauth
@endsection
