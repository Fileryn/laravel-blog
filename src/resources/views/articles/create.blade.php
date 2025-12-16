@extends('layouts.app')

@section('title', 'Nouvel Article - Laravel')

@section('content')
<h1 class="page-title">📝 Nouvel Article</h1>

<div class="card" style="max-width: 700px; margin: 0 auto;">
    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" placeholder="Titre de l'article" value="{{ old('titre') }}" required>
            @error('titre')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="categorie_id" class="form-label">Catégorie</label>
            <select name="categorie_id" id="categorie_id" class="form-control">
                <option value="">-- Aucune catégorie --</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        @if($tags->count() > 0)
        <div class="form-group">
            <label class="form-label">Tags</label>
            <div class="tags-checkboxes">
                @foreach($tags as $tag)
                    <label class="tag-checkbox">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                            {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                        <span class="tag-label" style="background: {{ $tag->couleur }};">{{ $tag->nom }}</span>
                    </label>
                @endforeach
            </div>
        </div>
        @endif

        <div class="form-group">
            <label for="image" class="form-label">Image (optionnel)</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @error('image')
                <div class="form-error">{{ $message }}</div>
            @enderror
            <small style="opacity: 0.7;">Formats acceptés : JPG, PNG, GIF. Max 2 Mo.</small>
        </div>

        <div class="form-group">
            <label for="contenu" class="form-label">Contenu</label>
            <textarea name="contenu" id="contenu" class="form-control" placeholder="Contenu de l'article..." required>{{ old('contenu') }}</textarea>
            @error('contenu')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('articles.index') }}" class="btn">Annuler</a>
            <button type="submit" class="btn btn-success">Créer l'article</button>
        </div>
    </form>
</div>

<style>
.tags-checkboxes {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.tag-checkbox {
    cursor: pointer;
}
.tag-checkbox input {
    display: none;
}
.tag-label {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.85rem;
    opacity: 0.5;
    transition: all 0.3s;
}
.tag-checkbox input:checked + .tag-label {
    opacity: 1;
    box-shadow: 0 0 0 2px white;
}
.tag-checkbox:hover .tag-label {
    opacity: 0.8;
}
</style>
@endsection
