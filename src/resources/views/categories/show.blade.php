@extends('layouts.app')

@section('title', $categorie->nom . ' - Laravel')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <div class="d-flex align-center justify-center gap-2 mb-3">
        <div style="width: 60px; height: 60px; border-radius: 50%; background-color: {{ $categorie->couleur }}; border: 3px solid white;"></div>
        <h1 class="mb-0">{{ $categorie->nom }}</h1>
    </div>
    
    <p class="text-center text-muted mb-3">{{ $articles->count() }} article(s) dans cette catégorie</p>

    <div class="d-flex justify-center gap-1 mb-3">
        <a href="{{ route('categories.index') }}" class="btn">← Retour aux catégories</a>
        @auth
            <a href="{{ route('categories.edit', $categorie) }}" class="btn btn-warning">✏️ Modifier</a>
        @endauth
    </div>

    @if($articles->count() > 0)
        @foreach($articles as $article)
        <div class="card">
            <h3 class="mb-1">{{ $article->titre }}</h3>
            <p class="text-muted mb-2">{{ Str::limit($article->contenu, 200) }}</p>
            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm">Lire l'article →</a>
        </div>
        @endforeach
    @else
        <div class="card text-center">
            <p class="text-muted">Aucun article dans cette catégorie.</p>
        </div>
    @endif
</div>
@endsection
