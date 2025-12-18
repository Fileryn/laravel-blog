@extends('layouts.app')

@section('title', 'Erreur serveur - Laravel Blog')

@section('content')
<div class="text-center" style="padding: 60px 20px;">
    <div style="font-size: 8rem; margin-bottom: 20px;">⚠️</div>
    <h1 style="font-size: 4rem; margin-bottom: 10px;">500</h1>
    <h2 class="mb-2">Erreur serveur</h2>
    <p class="text-muted mb-3">Quelque chose s'est mal passé de notre côté. Réessaie plus tard.</p>
    
    <div class="d-flex justify-center gap-1 flex-wrap">
        <a href="{{ url('/') }}" class="btn btn-primary">🏠 Retour à l'accueil</a>
        <a href="javascript:location.reload()" class="btn">🔄 Rafraîchir</a>
    </div>
</div>
@endsection
