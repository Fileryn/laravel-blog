@extends('layouts.app')

@section('title', 'Modifier la catégorie - Laravel')

@section('content')
<h1 class="page-title">✏️ Modifier la Catégorie</h1>

<div class="card" style="max-width: 500px; margin: 0 auto;">
    <form action="{{ route('categories.update', $categorie) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom" class="form-label">Nom de la catégorie</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $categorie->nom) }}" required>
            @error('nom')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="couleur" class="form-label">Couleur</label>
            <input type="color" name="couleur" id="couleur" class="form-control" value="{{ old('couleur', $categorie->couleur) }}" style="height: 50px; cursor: pointer;">
            @error('couleur')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('categories.index') }}" class="btn">Annuler</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
