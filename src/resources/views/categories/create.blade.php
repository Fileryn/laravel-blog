@extends('layouts.app')

@section('title', 'Nouvelle Catégorie - Laravel')

@section('content')
<h1 class="page-title">🏷️ Nouvelle Catégorie</h1>

<div class="card" style="max-width: 500px; margin: 0 auto;">
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nom" class="form-label">Nom de la catégorie</label>
            <input type="text" name="nom" id="nom" class="form-control" placeholder="Ex: Technologie" value="{{ old('nom') }}" required>
            @error('nom')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="couleur" class="form-label">Couleur</label>
            <input type="color" name="couleur" id="couleur" class="form-control" value="{{ old('couleur', '#667eea') }}" style="height: 50px; cursor: pointer;">
            @error('couleur')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('categories.index') }}" class="btn">Annuler</a>
            <button type="submit" class="btn btn-success">Créer la catégorie</button>
        </div>
    </form>
</div>
@endsection
