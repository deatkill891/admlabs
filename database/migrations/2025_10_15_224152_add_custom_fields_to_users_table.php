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
            // Añade la columna 'puesto' después de 'email'
            $table->string('puesto')->nullable()->after('email');
            // Añade la columna 'ubicacion' después de 'puesto'
            $table->string('ubicacion')->nullable()->after('puesto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['puesto', 'ubicacion']);
        });
    }
};