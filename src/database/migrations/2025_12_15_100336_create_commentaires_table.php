<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->string('auteur');                    // Nom de la personne qui commente
            $table->string('email')->nullable();         // Email (optionnel)
            $table->text('contenu');                     // Le texte du commentaire
            $table->foreignId('article_id')              // Lien vers l'article
                  ->constrained()
                  ->onDelete('cascade');                 // Si article supprimé, commentaires aussi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
