@extends('layouts.app')

@section('title', 'Inscription - Laravel Blog')

@section('content')
<div style="max-width: 400px; margin: 50px auto;">
    <div class="card">
        <h2 class="text-center mb-3">📝 Inscription</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="name">Nom</label>
                <input type="text" name="name" id="name" class="form-control" 
                       value="{{ old('name') }}" required autofocus autocomplete="name"
                       placeholder="Ton nom">
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" 
                       value="{{ old('email') }}" required autocomplete="username"
                       placeholder="ton@email.com">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" 
                       required autocomplete="new-password"
                       placeholder="••••••••">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="form-control" required autocomplete="new-password"
                       placeholder="••••••••">
                @error('password_confirmation')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success" style="width: 100%;">
                    Créer mon compte
                </button>
            </div>
        </form>
    </div>

    <div class="card text-center mt-2">
        <p class="mb-1">Déjà inscrit ?</p>
        <a href="{{ route('login') }}" class="btn">Se connecter</a>
    </div>
</div>
@endsection
