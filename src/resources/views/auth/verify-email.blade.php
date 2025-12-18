@extends('layouts.app')

@section('title', 'Vérification Email - Laravel Blog')

@section('content')
<div style="max-width: 500px; margin: 50px auto;">
    <div class="card text-center">
        <div style="font-size: 4rem; margin-bottom: 20px;">📧</div>
        
        <h2 class="mb-2">Vérifie ton email</h2>
        
        <p class="text-muted mb-2">
            Merci de t'être inscrit ! Avant de continuer, clique sur le lien de vérification que nous t'avons envoyé par email.
        </p>
        
        <p class="text-muted mb-3">
            Si tu n'as pas reçu l'email, nous pouvons t'en renvoyer un.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">
                ✅ Un nouveau lien de vérification a été envoyé à ton adresse email !
            </div>
        @endif

        <div class="d-flex justify-center gap-1 flex-wrap">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-success">
                    📤 Renvoyer l'email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn">
                    🚪 Déconnexion
                </button>
            </form>
        </div>
    </div>
    
    <div class="card mt-2">
        <h4 class="mb-1">💡 Conseils</h4>
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 5px 0;">📥 Vérifie ton dossier spam/courrier indésirable</li>
            <li style="padding: 5px 0;">⏱️ L'email peut mettre quelques minutes à arriver</li>
            <li style="padding: 5px 0;">📧 Email envoyé à : <strong>{{ Auth::user()->email }}</strong></li>
        </ul>
    </div>
</div>
@endsection
