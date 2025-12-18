@extends('layouts.app')

@section('title', 'À propos - Laravel Blog')

@section('content')
<div class="text-center" style="padding: 40px 0;">
    <h1 style="font-size: 3rem; margin-bottom: 20px;">🎨 À propos de ce projet</h1>
    <p style="font-size: 1.2rem; opacity: 0.9; margin-bottom: 30px;">
        Un blog moderne créé pendant mon stage de développement web.
    </p>
</div>

<div class="d-flex flex-wrap gap-2 justify-center mb-3">
    <div class="card" style="min-width: 280px; flex: 1; max-width: 400px;">
        <h3 class="mb-2">🛠️ Technologies utilisées</h3>
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <strong>Laravel 12</strong> - Framework PHP
            </li>
            <li style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <strong>PHP 8.2+</strong> - Langage backend
            </li>
            <li style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <strong>MySQL</strong> - Base de données
            </li>
            <li style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <strong>Blade</strong> - Moteur de templates
            </li>
            <li style="padding: 8px 0;">
                <strong>Railway</strong> - Hébergement
            </li>
        </ul>
    </div>

    <div class="card" style="min-width: 280px; flex: 1; max-width: 400px;">
        <h3 class="mb-2">✨ Fonctionnalités</h3>
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                ✅ Authentification complète
            </li>
            <li style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                ✅ CRUD Articles & Catégories
            </li>
            <li style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                ✅ Système de commentaires
            </li>
            <li style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                ✅ Tags avec relations Many-to-Many
            </li>
            <li style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                ✅ Rôles (Admin, Modérateur, User)
            </li>
            <li style="padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                ✅ Upload d'images
            </li>
            <li style="padding: 8px 0;">
                ✅ Pagination personnalisée
            </li>
        </ul>
    </div>
</div>

<div class="card text-center" style="max-width: 600px; margin: 0 auto;">
    <h3 class="mb-2">👨‍💻 Développeur</h3>
    <p class="mb-2">
        Projet réalisé par <strong>Fileryn</strong> dans le cadre d'un stage de développement web.
    </p>
    <div class="d-flex justify-center gap-1">
        <a href="https://github.com/Fileryn" target="_blank" class="btn">
            🔗 GitHub
        </a>
        <a href="{{ route('articles.index') }}" class="btn btn-primary">
            📝 Voir les articles
        </a>
    </div>
</div>
@endsection
