@extends('layouts.app')

@section('title', 'Confirmer le mot de passe - Laravel Blog')

@section('content')
<div style="max-width: 400px; margin: 50px auto;">
    <div class="card">
        <h2 class="text-center mb-2">🔒 Zone sécurisée</h2>
        
        <p class="text-muted text-center mb-3">
            Pour continuer, confirme ton mot de passe.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" 
                       required autocomplete="current-password"
                       placeholder="••••••••">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success" style="width: 100%;">
                    ✅ Confirmer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
