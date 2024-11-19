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
        Schema::create('persona_escuela', function (Blueprint $table) {
            $table->integer('idPersonaEscuela', true);
            $table->integer('idpersona')->unique('idpersona');
            $table->integer('idescuela')->index('idescuela');
            $table->tinyInteger('grado');
            $table->enum('seccion', ['A', 'B', 'C', 'D']);

            $table->unique(['idpersona', 'idescuela'], 'unique_persona_escuela');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona_escuela');
    }
};
