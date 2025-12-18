@extends('layouts.app')

@section('title', 'Mot de passe oublié - Laravel Blog')

@section('content')
<div style="max-width: 400px; margin: 50px auto;">
    <div class="card">
        <h2 class="text-center mb-2">🔐 Mot de passe oublié ?</h2>
        
        <p class="text-muted text-center mb-3">
            Pas de souci ! Entre ton email et on t'envoie un lien pour réinitialiser ton mot de passe.
        </p>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" 
                       value="{{ old('email') }}" required autofocus
                       placeholder="ton@email.com">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success" style="width: 100%;">
                    📧 Envoyer le lien
                </button>
            </div>
        </form>
    </div>

    <div class="card text-center mt-2">
        <p class="mb-1">Tu te souviens de ton mot de passe ?</p>
        <a href="{{ route('login') }}" class="btn">← Retour à la connexion</a>
    </div>
</div>
@endsection
