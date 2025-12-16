@extends('layouts.app')

@section('title', 'Bienvenue - Laravel')

@section('content')
<div class="text-center" style="padding: 40px 0;">
    <h1 style="font-size: 3.5rem; margin-bottom: 20px;">Bienvenue sur Laravel ! 🚀</h1>
    <p style="font-size: 1.3rem; opacity: 0.9; margin-bottom: 40px;">
        Ton environnement de développement fonctionne parfaitement
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
</div>

<!-- Derniers articles -->
@if($latestArticles->count() > 0)
<div class="mb-3">
    <h2 class="text-center mb-2">📰 Derniers Articles</h2>
    <div class="d-flex flex-wrap gap-2 justify-center">
        @foreach($latestArticles as $article)
        <div class="card" style="flex: 1; min-width: 280px; max-width: 350px;">
            <div class="d-flex align-center gap-1 mb-1">
                @if($article->categorie)
                    <span class="badge" style="background-color: {{ $article->categorie->couleur }};">
                        {{ $article->categorie->nom }}
                    </span>
                @endif
                <span class="text-muted" style="font-size: 0.85rem;">{{ $article->created_at->diffForHumans() }}</span>
            </div>
            <h3 class="mb-1">{{ $article->titre }}</h3>
            <p class="text-muted mb-2">{{ Str::limit($article->contenu, 100) }}</p>
            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm">Lire →</a>
        </div>
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
    <div class="d-flex justify-center gap-1">
        <a href="{{ route('articles.create') }}" class="btn btn-success">+ Nouvel Article</a>
        <a href="{{ route('categories.create') }}" class="btn">+ Nouvelle Catégorie</a>
    </div>
</div>
@endauth
@endsection
