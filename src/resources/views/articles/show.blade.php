@extends('layouts.app')

@section('title', $article->titre . ' - Laravel Blog')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <h1 class="page-title">{{ $article->titre }}</h1>
    
    <p class="text-center text-muted mb-2">
        📅 {{ $article->created_at->format('d/m/Y à H:i') }}
        @if($article->categorie)
            <a href="{{ route('categories.show', $article->categorie) }}" style="text-decoration: none;">
                <span class="badge" style="background-color: {{ $article->categorie->couleur }}; margin-left: 10px;">
                    {{ $article->categorie->nom }}
                </span>
            </a>
        @endif
        @if($article->user)
            • Par <strong>{{ $article->user->name }}</strong>
            @if($article->user->isAdmin())
                <span class="badge" style="background: #e74c3c; font-size: 0.7rem;">Admin</span>
            @elseif($article->user->isModerator())
                <span class="badge" style="background: #f39c12; font-size: 0.7rem;">Mod</span>
            @endif
        @endif
    </p>

    {{-- Tags de l'article --}}
    @if($article->tags->count() > 0)
    <div class="text-center mb-3">
        @foreach($article->tags as $tag)
            <span class="badge" style="background: {{ $tag->couleur }}; margin: 2px;">
                🏷️ {{ $tag->nom }}
            </span>
        @endforeach
    </div>
    @endif

    {{-- Image de l'article --}}
    @if($article->image)
    <div class="text-center mb-3">
        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->titre }}" 
             style="max-width: 100%; max-height: 400px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);"
             onerror="this.style.display='none';">
    </div>
    @endif
    
    <div class="card">
        <div style="font-size: 1.1rem; line-height: 1.8; white-space: pre-wrap;">{{ $article->contenu }}</div>
    </div>

    <div class="d-flex justify-center gap-1 flex-wrap">
        <a href="{{ route('articles.index') }}" class="btn">← Retour à la liste</a>
        @can('update', $article)
            <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning">✏️ Modifier</a>
        @endcan
        @can('delete', $article)
            <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cet article ?')">🗑️ Supprimer</button>
            </form>
        @endcan
    </div>

    {{-- Section commentaires --}}
    <div class="mt-3">
        <h3 class="mb-2">💬 Commentaires ({{ $article->commentaires->count() }})</h3>
        
        {{-- Formulaire pour ajouter un commentaire --}}
        <div class="card mb-2">
            <h4 class="mb-2">Laisser un commentaire</h4>
            <form action="{{ route('commentaires.store', $article) }}" method="POST">
                @csrf
                
                <div class="d-flex gap-1 mb-2" style="flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 200px;">
                        <input type="text" name="auteur" class="form-control" placeholder="Ton nom *" value="{{ old('auteur', Auth::user()->name ?? '') }}" required>
                        @error('auteur')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div style="flex: 1; min-width: 200px;">
                        <input type="email" name="email" class="form-control" placeholder="Ton email (optionnel)" value="{{ old('email', Auth::user()->email ?? '') }}">
                        @error('email')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-2">
                    <textarea name="contenu" class="form-control" placeholder="Ton commentaire..." rows="3" required>{{ old('contenu') }}</textarea>
                    @error('contenu')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-success">Envoyer le commentaire</button>
            </form>
        </div>

        {{-- Liste des commentaires --}}
        @if($article->commentaires->count() > 0)
            @foreach($article->commentaires as $commentaire)
            <div class="card">
                <div class="d-flex justify-between align-center mb-1">
                    <div>
                        <strong>{{ $commentaire->auteur }}</strong>
                        @if($commentaire->email)
                            <span class="text-muted" style="font-size: 0.85rem;">• {{ $commentaire->email }}</span>
                        @endif
                    </div>
                    <div class="d-flex align-center gap-1">
                        <span class="text-muted" style="font-size: 0.85rem;">{{ $commentaire->created_at->diffForHumans() }}</span>
                        @auth
                            @if(Auth::user()->isStaff() || (Auth::user()->email === $commentaire->email))
                            <form action="{{ route('commentaires.destroy', $commentaire) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce commentaire ?')">🗑️</button>
                            </form>
                            @endif
                        @endauth
                    </div>
                </div>
                <p class="mb-0" style="white-space: pre-wrap;">{{ $commentaire->contenu }}</p>
            </div>
            @endforeach
        @else
            <div class="card text-center">
                <p class="text-muted mb-0">Aucun commentaire pour l'instant. Sois le premier à commenter ! 😊</p>
            </div>
        @endif
    </div>
</div>
@endsection
