@extends('layouts.app')

@section('title', 'Articles - Laravel')

@section('content')
<h1 class="page-title">📄 Liste des Articles</h1>

@guest
<div class="alert alert-info">
    💡 <strong>Connecte-toi</strong> pour créer, modifier ou supprimer des articles !
</div>
@endguest

<div class="d-flex justify-center gap-1 mb-3">
    @auth
        <a href="{{ route('articles.create') }}" class="btn btn-success">+ Nouvel Article</a>
    @endauth
</div>

@if($articles->count() > 0)

{{-- Info pagination --}}
<p class="text-center text-muted mb-2">
    {{ $articles->total() }} article(s) • Page {{ $articles->currentPage() }} / {{ $articles->lastPage() }}
</p>

<table class="table">
    <thead>
        <tr>
            <th style="width: 60px;">Image</th>
            <th>Titre</th>
            <th>Catégorie</th>
            <th>Auteur</th>
            <th>Date</th>
            <th style="width: 250px;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
        <tr>
            <td>
                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" alt="" 
                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                @else
                    <span class="text-muted" style="font-size: 1.5rem;">📷</span>
                @endif
            </td>
            <td><strong>{{ $article->titre }}</strong></td>
            <td>
                @if($article->categorie)
                    <a href="{{ route('categories.show', $article->categorie) }}" style="text-decoration: none;">
                        <span class="badge" style="background-color: {{ $article->categorie->couleur }};">
                            {{ $article->categorie->nom }}
                        </span>
                    </a>
                @else
                    <span class="text-muted">—</span>
                @endif
            </td>
            <td>
                @if($article->user)
                    {{ $article->user->name }}
                @else
                    <span class="text-muted">—</span>
                @endif
            </td>
            <td class="text-muted">{{ $article->created_at->format('d/m/Y') }}</td>
            <td>
                <div class="d-flex gap-1">
                    <a href="{{ route('articles.show', $article) }}" class="btn btn-sm">Voir</a>
                    @can('update', $article)
                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-warning">Modifier</a>
                    @endcan
                    @can('delete', $article)
                        <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet article ?')">Supprimer</button>
                        </form>
                    @endcan
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Pagination custom --}}
@if($articles->hasPages())
<div class="pagination">
    {{-- Bouton Précédent --}}
    @if($articles->onFirstPage())
        <span class="pagination-btn disabled">← Précédent</span>
    @else
        <a href="{{ $articles->previousPageUrl() }}" class="pagination-btn">← Précédent</a>
    @endif

    {{-- Numéros de pages --}}
    @foreach($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
        @if($page == $articles->currentPage())
            <span class="pagination-btn active">{{ $page }}</span>
        @else
            <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
        @endif
    @endforeach

    {{-- Bouton Suivant --}}
    @if($articles->hasMorePages())
        <a href="{{ $articles->nextPageUrl() }}" class="pagination-btn">Suivant →</a>
    @else
        <span class="pagination-btn disabled">Suivant →</span>
    @endif
</div>
@endif

@else
<div class="card text-center">
    <p style="font-size: 3rem; margin-bottom: 10px;">📭</p>
    <p class="mb-2">Aucun article pour le moment.</p>
    @auth
        <a href="{{ route('articles.create') }}" class="btn btn-success">Créer mon premier article</a>
    @else
        <p class="text-muted">Connecte-toi pour créer un article !</p>
    @endauth
</div>
@endif
@endsection
