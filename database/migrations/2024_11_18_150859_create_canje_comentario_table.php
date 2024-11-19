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
        Schema::create('canje_comentario', function (Blueprint $table) {
            $table->integer('idComentario', true);
            $table->integer('idcanje')->unique('idcanje');
            $table->string('fotoObjeto', 400);
            $table->string('comentario');
            $table->dateTime('fechaComentario');
            $table->tinyInteger('puntuacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canje_comentario');
    }
};
