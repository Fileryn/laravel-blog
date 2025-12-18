@extends('layouts.app')

@section('title', 'Mon Profil - Laravel Blog')

@section('content')
<h1 class="page-title">👤 Mon Profil</h1>

<div class="profile-grid">
    {{-- Informations du profil --}}
    <div class="card">
        <h3 class="mb-2">📝 Informations personnelles</h3>
        
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label class="form-label" for="name">Nom</label>
                <input type="text" name="name" id="name" class="form-control" 
                       value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" 
                       value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Rôle</label>
                <div class="form-control" style="background: rgba(255,255,255,0.05); cursor: not-allowed;">
                    <span class="badge" style="background: {{ $user->isAdmin() ? '#e74c3c' : ($user->isModerator() ? '#f39c12' : '#3498db') }};">
                        {{ ucfirst($user->role ?? 'user') }}
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Membre depuis</label>
                <div class="form-control" style="background: rgba(255,255,255,0.05); cursor: not-allowed;">
                    {{ $user->created_at->format('d/m/Y à H:i') }}
                </div>
            </div>

            <button type="submit" class="btn btn-success">💾 Sauvegarder</button>
        </form>
    </div>

    {{-- Changer le mot de passe --}}
    <div class="card">
        <h3 class="mb-2">🔐 Changer le mot de passe</h3>
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label" for="current_password">Mot de passe actuel</label>
                <input type="password" name="current_password" id="current_password" 
                       class="form-control" placeholder="••••••••">
                @error('current_password', 'updatePassword')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Nouveau mot de passe</label>
                <input type="password" name="password" id="password" 
                       class="form-control" placeholder="••••••••">
                @error('password', 'updatePassword')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirmer le nouveau mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="form-control" placeholder="••••••••">
                @error('password_confirmation', 'updatePassword')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning">🔑 Changer le mot de passe</button>
        </form>
    </div>

    {{-- Statistiques --}}
    <div class="card">
        <h3 class="mb-2">📊 Mes statistiques</h3>
        
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number">{{ $user->articles()->count() }}</span>
                <span class="stat-label">Articles</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ \App\Models\Commentaire::where('email', $user->email)->count() }}</span>
                <span class="stat-label">Commentaires</span>
            </div>
        </div>

        <div class="mt-2">
            <a href="{{ route('dashboard') }}" class="btn">📊 Voir mon Dashboard</a>
        </div>
    </div>

    {{-- Supprimer le compte --}}
    <div class="card" style="border: 2px solid #e74c3c;">
        <h3 class="mb-2">⚠️ Zone dangereuse</h3>
        <p class="text-muted mb-2">
            Une fois ton compte supprimé, toutes tes données seront définitivement effacées.
        </p>
        
        <form method="POST" action="{{ route('profile.destroy') }}" 
              onsubmit="return confirm('Es-tu sûr de vouloir supprimer ton compte ? Cette action est irréversible !');">
            @csrf
            @method('DELETE')

            <div class="form-group">
                <label class="form-label" for="delete_password">Confirme avec ton mot de passe</label>
                <input type="password" name="password" id="delete_password" 
                       class="form-control" placeholder="••••••••" required>
                @error('password', 'userDeletion')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-danger">🗑️ Supprimer mon compte</button>
        </form>
    </div>
</div>

<style>
.profile-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 20px;
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
