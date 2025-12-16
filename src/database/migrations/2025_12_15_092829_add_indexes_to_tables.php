<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Les index accélèrent les recherches dans la base de données
     */
    public function up(): void
    {
        // Index sur la table articles
        Schema::table('articles', function (Blueprint $table) {
            $table->index('created_at');  // Pour trier par date
            $table->index('titre');       // Pour rechercher par titre
        });

        // Index sur la table categories
        Schema::table('categories', function (Blueprint $table) {
            $table->index('nom');  // Pour trier/rechercher par nom
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['titre']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['nom']);
        });
    }
};
