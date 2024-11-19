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
        Schema::create('persona', function (Blueprint $table) {
            $table->integer('idPersona', true);
            $table->integer('idusuario')->index('idusuario');
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fechaNacimiento');
            $table->string('direccion', 90);
            $table->char('telefono', 9);
            $table->enum('genero', ['Masculino', 'Femenino']);
            $table->binary('foto');

            $table->unique(['idusuario'], 'idusuario_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona');
    }
};
