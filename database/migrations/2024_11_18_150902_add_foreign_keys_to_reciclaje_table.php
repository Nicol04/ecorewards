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
        Schema::table('reciclaje', function (Blueprint $table) {
            $table->foreign(['idmaterial'], 'reciclaje_ibfk_2')->references(['idMaterial'])->on('material')->onUpdate('cascade')->onDelete('no action');
            $table->foreign(['idusuario'], 'reciclaje_ibfk_3')->references(['idUsuario'])->on('usuario')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reciclaje', function (Blueprint $table) {
            $table->dropForeign('reciclaje_ibfk_2');
            $table->dropForeign('reciclaje_ibfk_3');
        });
    }
};
