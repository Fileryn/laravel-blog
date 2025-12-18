@extends('layouts.app')

@section('title', 'Réinitialiser le mot de passe - Laravel Blog')

@section('content')
<div style="max-width: 400px; margin: 50px auto;">
    <div class="card">
        <h2 class="text-center mb-3">🔑 Nouveau mot de passe</h2>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" 
                       value="{{ old('email', $request->email) }}" required autofocus>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Nouveau mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" 
                       required placeholder="••••••••">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="form-control" required placeholder="••••••••">
                @error('password_confirmation')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success" style="width: 100%;">
                    ✅ Réinitialiser le mot de passe
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
