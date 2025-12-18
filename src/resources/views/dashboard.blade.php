@extends('layouts.app')

@section('title', 'Dashboard - Laravel Blog')

@section('content')
<h1 class="page-title">📊 Mon Dashboard</h1>

<div class="dashboard-grid">
    {{-- Carte Profil --}}
    <div class="card">
        <h3 class="mb-2">👤 Mon Profil</h3>
        <div class="profile-info">
            <p><strong>Nom :</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
            <p><strong>Rôle :</strong> 
                <span class="badge" style="background: {{ Auth::user()->isAdmin() ? '#e74c3c' : (Auth::user()->isModerator() ? '#f39c12' : '#3498db') }};">
                    {{ ucfirst(Auth::user()->role ?? 'user') }}
                </span>
            </p>
            <p><strong>Membre depuis :</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>
        </div>
        <div class="mt-2">
            <a href="{{ route('profile.edit') }}" class="btn btn-sm">✏️ Modifier mon profil</a>
        </div>
    </div>

    {{-- Carte Statistiques --}}
    <div class="card">
        <h3 class="mb-2">📈 Mes Statistiques</h3>
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number">{{ Auth::user()->articles()->count() }}</span>
                <span class="stat-label">Articles publiés</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ \App\Models\Commentaire::where('email', Auth::user()->email)->count() }}</span>
                <span class="stat-label">Commentaires</span>
            </div>
        </div>
    </div>

    {{-- Carte Actions rapides --}}
    <div class="card">
        <h3 class="mb-2">⚡ Actions rapides</h3>
        <div class="d-flex gap-1 flex-wrap">
            <a href="{{ route('articles.create') }}" class="btn btn-success">+ Nouvel Article</a>
            <a href="{{ route('articles.index') }}" class="btn">📝 Voir les articles</a>
            <a href="{{ route('categories.index') }}" class="btn">🏷️ Catégories</a>
        </div>
    </div>

    {{-- Mes derniers articles --}}
    <div class="card">
        <h3 class="mb-2">📝 Mes derniers articles</h3>
        @php
            $mesArticles = Auth::user()->articles()->latest()->take(5)->get();
        @endphp
        @if($mesArticles->count() > 0)
            <ul style="list-style: none; padding: 0; margin: 0;">
                @foreach($mesArticles as $article)
                    <li style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <a href="{{ route('articles.show', $article) }}" style="color: white; text-decoration: none;">
                            {{ $article->titre }}
                        </a>
                        <span class="text-muted" style="font-size: 0.85rem;">
                            • {{ $article->created_at->diffForHumans() }}
                        </span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">Tu n'as pas encore d'articles. <a href="{{ route('articles.create') }}" style="color: #3498db;">Crée ton premier article !</a></p>
        @endif
    </div>

    {{-- Panel Admin/Modérateur --}}
    @if(Auth::user()->isStaff())
    <div class="card" style="border: 2px solid {{ Auth::user()->isAdmin() ? '#e74c3c' : '#f39c12' }};">
        <h3 class="mb-2">🛡️ Panel {{ Auth::user()->isAdmin() ? 'Admin' : 'Modérateur' }}</h3>
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number">{{ \App\Models\User::count() }}</span>
                <span class="stat-label">Utilisateurs</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ \App\Models\Article::count() }}</span>
                <span class="stat-label">Articles total</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ \App\Models\Commentaire::count() }}</span>
                <span class="stat-label">Commentaires</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ \App\Models\Categorie::count() }}</span>
                <span class="stat-label">Catégories</span>
            </div>
        </div>
        @if(Auth::user()->isAdmin())
        <div class="mt-2">
            <p class="text-muted mb-1">En tant qu'admin, tu peux modifier et supprimer tous les contenus.</p>
        </div>
        @endif
    </div>
    @endif
</div>

<style>
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}
.profile-info p {
    margin: 8px 0;
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}
.stat-item {
    text-align: center;
    padding: 15px;
    background: rgba(255,255,255,0.1);
    border-radius: 10px;
}
.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: bold;
}
.stat-label {
    display: block;
    font-size: 0.85rem;
    opacity: 0.7;
}
</style>
@endsection
