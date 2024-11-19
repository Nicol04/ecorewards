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
        Schema::table('canjes', function (Blueprint $table) {
            $table->foreign(['idrecompensa'], 'canjes_ibfk_2')->references(['idRecompensa'])->on('recompensa')->onUpdate('cascade')->onDelete('no action');
            $table->foreign(['idusuario'], 'canjes_ibfk_3')->references(['idUsuario'])->on('usuario')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('canjes', function (Blueprint $table) {
            $table->dropForeign('canjes_ibfk_2');
            $table->dropForeign('canjes_ibfk_3');
        });
    }
};
