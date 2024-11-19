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
        Schema::create('recompensa', function (Blueprint $table) {
            $table->integer('idRecompensa')->primary();
            $table->string('nombreRecompensa', 100);
            $table->string('descripcion');
            $table->integer('puntosRequeridos');
            $table->integer('stock');
            $table->binary('imagen');
            $table->integer('idcategoria')->unique('idcategoria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recompensa');
    }
};
