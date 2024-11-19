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
        Schema::create('reciclaje', function (Blueprint $table) {
            $table->integer('idReciclaje', true);
            $table->integer('idusuario')->unique('idusuario');
            $table->date('fechaReciclaje');
            $table->integer('idmaterial')->unique('idmaterial');
            $table->decimal('cantidad', 10, 0);
            $table->integer('puntosObtenidos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reciclaje');
    }
};
