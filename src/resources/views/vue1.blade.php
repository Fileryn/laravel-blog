@section('title', 'Ma Vue - Laravel')


@extends('layouts.app')

@section('title', 'Ma Vue - Laravel')

@section('content')
<div class="text-center" style="padding: 60px 0;">
    <h1 style="font-size: 3rem; margin-bottom: 20px;">🎨 Je suis une vue !</h1>
    <p style="font-size: 1.2rem; opacity: 0.9; margin-bottom: 30px;">
        Bienvenue dans ma première vue Blade avec Laravel.
    </p>
    
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <h3 class="mb-2">📚 Ce que j'ai appris :</h3>
        <ul style="text-align: left; line-height: 2;">
            <li>Créer des vues Blade</li>
            <li>Utiliser des layouts</li>
            <li>Créer des modèles et migrations</li>
            <li>Faire un CRUD complet</li>
            <li>Gérer l'authentification</li>
            <li>Créer des relations entre tables</li>
        </ul>
    </div>
</div>
@endsection

@section('footer')
<div class="text-center" style="padding: 20px 0; font-size: 0.9rem; color: #666;">
    &copy; 2024 Mon Application Laravel. Tous droits réservés.
</div>
@endsection