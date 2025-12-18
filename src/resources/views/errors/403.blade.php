@extends('layouts.app')

@section('title', 'Accès interdit - Laravel Blog')

@section('content')
<div class="text-center" style="padding: 60px 20px;">
    <div style="font-size: 8rem; margin-bottom: 20px;">🚫</div>
    <h1 style="font-size: 4rem; margin-bottom: 10px;">403</h1>
    <h2 class="mb-2">Accès interdit</h2>
    <p class="text-muted mb-3">Tu n'as pas la permission d'accéder à cette page.</p>
    
    <div class="d-flex justify-center gap-1 flex-wrap">
        <a href="{{ url('/') }}" class="btn btn-primary">🏠 Retour à l'accueil</a>
        @guest
            <a href="{{ route('login') }}" class="btn">🔑 Se connecter</a>
        @endguest
    </div>
</div>
@endsection
