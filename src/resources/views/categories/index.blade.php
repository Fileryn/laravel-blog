@extends('layouts.app')

@section('title', 'Catégories - Laravel Blog')

@section('content')
<h1 class="page-title">🏷️ Liste des Catégories</h1>

@guest
<div class="alert alert-info">
    💡 <strong>Connecte-toi</strong> pour créer, modifier ou supprimer des catégories !
</div>
@endguest

<div class="d-flex justify-center gap-1 mb-3">
    @auth
        <a href="{{ route('categories.create') }}" class="btn btn-success">+ Nouvelle Catégorie</a>
    @endauth
</div>

@if($categories->count() > 0)
<p class="text-center text-muted mb-2">{{ $categories->count() }} catégorie(s) au total</p>

<div class="d-flex flex-wrap gap-2 justify-center">
    @foreach($categories as $categorie)
    <div class="card" style="min-width: 280px; flex: 1; max-width: 350px;">
        <div class="d-flex align-center gap-2 mb-2">
            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: {{ $categorie->couleur }}; border: 3px solid white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                🏷️
            </div>
            <div>
                <h3 class="mb-0">{{ $categorie->nom }}</h3>
                <span class="text-muted">{{ $categorie->articles_count }} article(s)</span>
            </div>
        </div>
        
        @if($categorie->description)
            <p class="text-muted mb-2" style="font-size: 0.9rem;">{{ Str::limit($categorie->description, 80) }}</p>
        @endif
        
        <div class="d-flex gap-1 mt-2">
            <a href="{{ route('categories.show', $categorie) }}" class="btn btn-sm">👁️ Voir</a>
            @can('update', $categorie)
                <a href="{{ route('categories.edit', $categorie) }}" class="btn btn-sm btn-warning">✏️ Modifier</a>
            @endcan
            @can('delete', $categorie)
                <form action="{{ route('categories.destroy', $categorie) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette catégorie ?')">🗑️</button>
                </form>
            @endcan
        </div>
    </div>
    @endforeach
</div>
@else
<div class="card text-center">
    <div style="font-size: 4rem; margin-bottom: 15px;">📁</div>
    <p class="mb-2">Aucune catégorie pour le moment.</p>
    @auth
        <a href="{{ route('categories.create') }}" class="btn btn-success">Créer ma première catégorie</a>
    @else
        <p class="text-muted">Connecte-toi pour créer une catégorie !</p>
    @endauth
</div>
@endif
@endsection
