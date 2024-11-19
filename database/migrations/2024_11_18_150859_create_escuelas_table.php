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
        Schema::create('escuelas', function (Blueprint $table) {
            $table->integer('idEscuela', true);
            $table->string('nombreEscuela', 150)->unique('nombreescuela');
            $table->string('direccion')->nullable();
            $table->string('telefono', 9)->nullable();
            $table->string('director', 100)->nullable();
            $table->string('logoEscuela');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escuelas');
    }
};
