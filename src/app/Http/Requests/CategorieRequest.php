<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $categorieId = $this->route('categorie')?->id;
        
        return [
            'nom' => 'required|string|max:255|unique:categories,nom,' . $categorieId,
            'couleur' => 'required|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'nom.unique' => 'Cette catégorie existe déjà.',
            'couleur.required' => 'La couleur est obligatoire.',
            'couleur.regex' => 'La couleur doit être un code hexadécimal (ex: #667eea).',
        ];
    }
}
