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
        Schema::table('puntos', function (Blueprint $table) {
            $table->foreign(['idusuario'], 'puntos_ibfk_1')->references(['idUsuario'])->on('usuario')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('puntos', function (Blueprint $table) {
            $table->dropForeign('puntos_ibfk_1');
        });
    }
};
