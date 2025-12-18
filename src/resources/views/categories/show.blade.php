@extends('layouts.app')

@section('title', $categorie->nom . ' - Laravel Blog')
@section('description', 'Articles de la catégorie ' . $categorie->nom)

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    {{-- Breadcrumb --}}
    <nav style="margin-bottom: 20px; opacity: 0.8; text-align: center;">
        <a href="{{ url('/') }}" style="color: white; text-decoration: none;">🏠 Accueil</a>
        <span style="margin: 0 10px;">›</span>
        <a href="{{ route('categories.index') }}" style="color: white; text-decoration: none;">🏷️ Catégories</a>
        <span style="margin: 0 10px;">›</span>
        <span>{{ $categorie->nom }}</span>
    </nav>

    {{-- Header catégorie --}}
    <div class="card text-center mb-3" style="border: 3px solid {{ $categorie->couleur }};">
        <div class="d-flex align-center justify-center gap-2 mb-2">
            <div style="width: 70px; height: 70px; border-radius: 50%; background-color: {{ $categorie->couleur }}; 
                        border: 3px solid white; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                🏷️
            </div>
            <div>
                <h1 class="mb-0">{{ $categorie->nom }}</h1>
                <p class="text-muted mb-0">{{ $articles->total() }} article(s)</p>
            </div>
        </div>
        
        @if($categorie->description)
            <p class="text-muted">{{ $categorie->description }}</p>
        @endif

        <div class="d-flex justify-center gap-1">
            <a href="{{ route('categories.index') }}" class="btn btn-sm">← Toutes les catégories</a>
            @can('update', $categorie)
                <a href="{{ route('categories.edit', $categorie) }}" class="btn btn-sm btn-warning">✏️ Modifier</a>
            @endcan
            @auth
                <a href="{{ route('articles.create') }}" class="btn btn-sm btn-success">+ Nouvel article</a>
            @endauth
        </div>
    </div>

    {{-- Liste des articles --}}
    @if($articles->count() > 0)
        <div class="d-flex flex-wrap gap-2">
            @foreach($articles as $article)
            <div class="card" style="flex: 1; min-width: 280px; max-width: 400px;">
                @if($article->image)
                <div style="margin: -25px -25px 15px -25px; border-radius: 15px 15px 0 0; overflow: hidden; height: 150px;">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->titre }}" 
                         style="width: 100%; height: 100%; object-fit: cover;"
                         onerror="this.parentElement.style.display='none';">
                </div>
                @endif
                
                <h3 class="mb-1">{{ $article->titre }}</h3>
                
                <p class="text-muted mb-1" style="font-size: 0.85rem;">
                    ✍️ {{ $article->user->name ?? 'Anonyme' }} • {{ $article->created_at->diffForHumans() }}
                    • 💬 {{ $article->commentaires->count() }}
                </p>
                
                <p class="text-muted mb-2">{{ Str::limit($article->contenu, 120) }}</p>
                
                @if($article->tags->count() > 0)
                <div class="mb-2">
                    @foreach($article->tags->take(3) as $tag)
                        <span class="badge" style="background: {{ $tag->couleur }}; font-size: 0.7rem;">
                            {{ $tag->nom }}
                        </span>
                    @endforeach
                </div>
                @endif
                
                <a href="{{ route('articles.show', $article) }}" class="btn btn-sm">Lire l'article →</a>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($articles->hasPages())
        <div class="pagination mt-3">
            @if($articles->onFirstPage())
                <span class="pagination-btn disabled">← Précédent</span>
            @else
                <a href="{{ $articles->previousPageUrl() }}" class="pagination-btn">← Précédent</a>
            @endif

            @foreach($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                @if($page == $articles->currentPage())
                    <span class="pagination-btn active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
                @endif
            @endforeach

            @if($articles->hasMorePages())
                <a href="{{ $articles->nextPageUrl() }}" class="pagination-btn">Suivant →</a>
            @else
                <span class="pagination-btn disabled">Suivant →</span>
            @endif
        </div>
        @endif
    @else
        <div class="card text-center">
            <div style="font-size: 4rem; margin-bottom: 15px;">📭</div>
            <p class="text-muted mb-2">Aucun article dans cette catégorie.</p>
            @auth
                <a href="{{ route('articles.create') }}" class="btn btn-success">Créer le premier article</a>
            @endauth
        </div>
    @endif
</div>
@endsection
