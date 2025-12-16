<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Autorisation gérée par le middleware
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string|min:10',
            'categorie_id' => 'nullable|exists:categories,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre est obligatoire.',
            'titre.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'contenu.required' => 'Le contenu est obligatoire.',
            'contenu.min' => 'Le contenu doit faire au moins 10 caractères.',
            'categorie_id.exists' => 'Cette catégorie n\'existe pas.',
        ];
    }
}
