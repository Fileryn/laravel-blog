@extends('layouts.app')

@section('title', 'Connexion - Laravel Blog')

@section('content')
<div style="max-width: 400px; margin: 50px auto;">
    <div class="card">
        <h2 class="text-center mb-3">🔑 Connexion</h2>
        
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" 
                       value="{{ old('email') }}" required autofocus autocomplete="username"
                       placeholder="ton@email.com">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" 
                       required autocomplete="current-password"
                       placeholder="••••••••">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="checkbox" name="remember" style="width: 18px; height: 18px;">
                    <span>Se souvenir de moi</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success" style="width: 100%;">
                    Se connecter
                </button>
            </div>
        </form>

        <div class="text-center mt-3">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="color: rgba(255,255,255,0.7);">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>
    </div>

    <div class="card text-center mt-2">
        <p class="mb-1">Pas encore de compte ?</p>
        <a href="{{ route('register') }}" class="btn btn-primary">Créer un compte</a>
    </div>
</div>
@endsection
