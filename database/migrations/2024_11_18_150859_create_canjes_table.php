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
        Schema::create('canjes', function (Blueprint $table) {
            $table->integer('idCanje', true);
            $table->integer('idusuario');
            $table->integer('idrecompensa')->index('idrecompensa');
            $table->date('fechaCanje');
            $table->integer('puntosUtilizados');

            $table->unique(['idusuario', 'idrecompensa'], 'idusuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canjes');
    }
};
