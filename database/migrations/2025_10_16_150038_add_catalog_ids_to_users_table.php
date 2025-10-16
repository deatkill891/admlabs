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
        Schema::table('users', function (Blueprint $table) {
            // Añade la columna para el ID del tipo de usuario
            $table->unsignedBigInteger('IdTipoUsuario')->nullable()->after('is_admin');

            // Añade la columna para el ID de la ubicación
            $table->unsignedBigInteger('IdUbicacion')->nullable()->after('IdTipoUsuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Esto es para poder revertir el cambio si es necesario
            $table->dropColumn(['IdTipoUsuario', 'IdUbicacion']);
        });
    }
};