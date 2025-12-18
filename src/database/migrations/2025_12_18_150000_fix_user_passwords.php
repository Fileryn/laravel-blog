<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        // Trouver tous les utilisateurs avec un mot de passe non-bcrypt et les corriger
        $users = DB::table('users')->get();
        
        foreach ($users as $user) {
            // Si le mot de passe ne commence pas par $2y$ (bcrypt), le réinitialiser
            if (!str_starts_with($user->password, '$2y$')) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['password' => Hash::make('password123')]);
            }
        }
    }

    public function down(): void
    {
        // Pas de rollback possible pour cette migration
    }
};
