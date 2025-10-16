<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Usamos unsignedBigInteger para llaves foráneas
            $table->unsignedBigInteger('idTipoUsuario')->nullable()->after('is_admin');
            $table->unsignedBigInteger('idUbicacion')->nullable()->after('idTipoUsuario');

            // Opcional: Definir las llaves foráneas si quieres integridad referencial
            // $table->foreign('idTipoUsuario')->references('idTipoUsuario')->on('CatTipoUsuario');
            // $table->foreign('idUbicacion')->references('idUbicacion')->on('CatUbicaciones');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['idTipoUsuario', 'idUbicacion']);
        });
    }
};