@extends('layouts.app')

@section('title', 'Nouvel Article - Laravel Blog')

@section('content')
<h1 class="page-title">📝 Nouvel Article</h1>

<div class="card" style="max-width: 700px; margin: 0 auto;">
    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="titre" class="form-label">Titre *</label>
            <input type="text" name="titre" id="titre" class="form-control" 
                   placeholder="Un titre accrocheur..." value="{{ old('titre') }}" required
                   maxlength="255">
            @error('titre')
                <div class="form-error">{{ $message }}</div>
            @enderror
            <small class="text-muted">Maximum 255 caractères</small>
        </div>

        <div class="d-flex gap-1" style="flex-wrap: wrap;">
            <div class="form-group" style="flex: 1; min-width: 200px;">
                <label for="categorie_id" class="form-label">Catégorie</label>
                <select name="categorie_id" id="categorie_id" class="form-control">
                    <option value="">-- Aucune catégorie --</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}
                                style="background-color: {{ $categorie->couleur }};">
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">
                    <a href="{{ route('categories.create') }}" style="color: #3498db;">+ Créer une catégorie</a>
                </small>
            </div>

            <div class="form-group" style="flex: 1; min-width: 200px;">
                <label for="image" class="form-label">Image de couverture</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*"
                       onchange="previewImage(this)">
                @error('image')
                    <div class="form-error">{{ $message }}</div>
                @enderror
                <small class="text-muted">JPG, PNG, GIF. Max 2 Mo.</small>
            </div>
        </div>

        <div id="image-preview" style="display: none; margin-bottom: 15px; text-align: center;">
            <img id="preview-img" src="" alt="Aperçu" style="max-width: 100%; max-height: 200px; border-radius: 10px;">
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
            <small class="text-muted">Sélectionne un ou plusieurs tags</small>
        </div>
        @endif

        <div class="form-group">
            <label for="contenu" class="form-label">Contenu *</label>
            <textarea name="contenu" id="contenu" class="form-control" 
                      placeholder="Écris ton article ici..." required
                      style="min-height: 300px;">{{ old('contenu') }}</textarea>
            @error('contenu')
                <div class="form-error">{{ $message }}</div>
            @enderror
            <small class="text-muted">
                <span id="char-count">0</span> caractères
            </small>
        </div>

        <div class="form-actions">
            <a href="{{ route('articles.index') }}" class="btn">← Annuler</a>
            <button type="submit" class="btn btn-success">✨ Publier l'article</button>
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

<script>
function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const img = document.getElementById('preview-img');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}

document.getElementById('contenu').addEventListener('input', function() {
    document.getElementById('char-count').textContent = this.value.length;
});
</script>
@endsection
