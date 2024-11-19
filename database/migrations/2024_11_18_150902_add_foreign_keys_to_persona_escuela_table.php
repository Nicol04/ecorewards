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
        Schema::table('persona_escuela', function (Blueprint $table) {
            $table->foreign(['idpersona'], 'persona_escuela_ibfk_2')->references(['idPersona'])->on('persona')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['idescuela'], 'persona_escuela_ibfk_3')->references(['idEscuela'])->on('escuelas')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('persona_escuela', function (Blueprint $table) {
            $table->dropForeign('persona_escuela_ibfk_2');
            $table->dropForeign('persona_escuela_ibfk_3');
        });
    }
};
