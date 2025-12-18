@extends('layouts.app')

@section('title', $article->titre . ' - Laravel Blog')
@section('description', Str::limit($article->contenu, 160))

@section('content')
<article style="max-width: 800px; margin: 0 auto;">
    {{-- Breadcrumb --}}
    <nav style="margin-bottom: 20px; opacity: 0.8;">
        <a href="{{ url('/') }}" style="color: white; text-decoration: none;">🏠 Accueil</a>
        <span style="margin: 0 10px;">›</span>
        <a href="{{ route('articles.index') }}" style="color: white; text-decoration: none;">📝 Articles</a>
        @if($article->categorie)
            <span style="margin: 0 10px;">›</span>
            <a href="{{ route('categories.show', $article->categorie) }}" style="color: white; text-decoration: none;">
                {{ $article->categorie->nom }}
            </a>
        @endif
        <span style="margin: 0 10px;">›</span>
        <span>{{ Str::limit($article->titre, 30) }}</span>
    </nav>

    {{-- Image de l'article --}}
    @if($article->image)
    <div class="text-center mb-3">
        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->titre }}" 
             style="max-width: 100%; max-height: 400px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);"
             onerror="this.style.display='none';">
    </div>
    @endif

    <h1 class="page-title">{{ $article->titre }}</h1>
    
    {{-- Métadonnées --}}
    <div class="text-center mb-2" style="display: flex; justify-content: center; align-items: center; gap: 15px; flex-wrap: wrap;">
        <span>📅 {{ $article->created_at->format('d/m/Y à H:i') }}</span>
        
        @if($article->categorie)
            <a href="{{ route('categories.show', $article->categorie) }}" style="text-decoration: none;">
                <span class="badge" style="background-color: {{ $article->categorie->couleur }};">
                    {{ $article->categorie->nom }}
                </span>
            </a>
        @endif
        
        @if($article->user)
            <span>
                ✍️ Par <strong>{{ $article->user->name }}</strong>
                @if($article->user->isAdmin())
                    <span class="badge" style="background: #e74c3c; font-size: 0.7rem;">Admin</span>
                @elseif($article->user->isModerator())
                    <span class="badge" style="background: #f39c12; font-size: 0.7rem;">Mod</span>
                @endif
            </span>
        @endif
        
        <span>💬 {{ $article->commentaires->count() }} commentaire(s)</span>
    </div>

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
    
    {{-- Contenu de l'article --}}
    <div class="card">
        <div style="font-size: 1.1rem; line-height: 1.8; white-space: pre-wrap;">{{ $article->contenu }}</div>
    </div>

    {{-- Boutons d'action --}}
    <div class="d-flex justify-center gap-1 flex-wrap mb-3">
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

    {{-- Partage --}}
    <div class="card text-center mb-3">
        <h4 class="mb-2">📤 Partager cet article</h4>
        <div class="d-flex justify-center gap-1 flex-wrap">
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->titre) }}" 
               target="_blank" class="btn btn-sm" style="background: #1DA1F2;">
                🐦 Twitter
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
               target="_blank" class="btn btn-sm" style="background: #4267B2;">
                📘 Facebook
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($article->titre) }}" 
               target="_blank" class="btn btn-sm" style="background: #0077B5;">
                💼 LinkedIn
            </a>
            <button onclick="navigator.clipboard.writeText('{{ request()->url() }}'); alert('Lien copié !');" 
                    class="btn btn-sm">
                📋 Copier le lien
            </button>
        </div>
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
                        <input type="text" name="auteur" class="form-control" placeholder="Ton nom *" 
                               value="{{ old('auteur', Auth::user()->name ?? '') }}" required>
                        @error('auteur')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div style="flex: 1; min-width: 200px;">
                        <input type="email" name="email" class="form-control" placeholder="Ton email (optionnel)" 
                               value="{{ old('email', Auth::user()->email ?? '') }}">
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
                
                <button type="submit" class="btn btn-success">💬 Envoyer le commentaire</button>
            </form>
        </div>

        {{-- Liste des commentaires --}}
        @if($article->commentaires->count() > 0)
            @foreach($article->commentaires->sortByDesc('created_at') as $commentaire)
            <div class="card">
                <div class="d-flex justify-between align-center mb-1" style="flex-wrap: wrap; gap: 10px;">
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

    {{-- Articles similaires --}}
    @if($article->categorie)
        @php
            $articlesSimulaires = \App\Models\Article::where('categorie_id', $article->categorie_id)
                ->where('id', '!=', $article->id)
                ->latest()
                ->take(3)
                ->get();
        @endphp
        @if($articlesSimulaires->count() > 0)
        <div class="mt-3">
            <h3 class="mb-2">📚 Articles similaires</h3>
            <div class="d-flex flex-wrap gap-2">
                @foreach($articlesSimulaires as $similar)
                <div class="card" style="flex: 1; min-width: 200px;">
                    <h4 style="font-size: 1rem;">{{ Str::limit($similar->titre, 40) }}</h4>
                    <p class="text-muted mb-1" style="font-size: 0.85rem;">{{ $similar->created_at->diffForHumans() }}</p>
                    <a href="{{ route('articles.show', $similar) }}" class="btn btn-sm">Lire →</a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    @endif
</article>
@endsection
