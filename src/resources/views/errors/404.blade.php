@extends('layouts.app')

@section('title', 'Page non trouvée - Laravel Blog')

@section('content')
<div class="text-center" style="padding: 60px 20px;">
    <div style="font-size: 8rem; margin-bottom: 20px;">🔍</div>
    <h1 style="font-size: 4rem; margin-bottom: 10px;">404</h1>
    <h2 class="mb-2">Oups ! Page non trouvée</h2>
    <p class="text-muted mb-3">La page que tu cherches n'existe pas ou a été déplacée.</p>
    
    <div class="d-flex justify-center gap-1 flex-wrap">
        <a href="{{ url('/') }}" class="btn btn-primary">🏠 Retour à l'accueil</a>
        <a href="{{ route('articles.index') }}" class="btn">📝 Voir les articles</a>
    </div>
</div>
@endsection
