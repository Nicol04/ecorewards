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
        Schema::table('recompensa', function (Blueprint $table) {
            $table->foreign(['idcategoria'], 'recompensa_ibfk_1')->references(['idCategoria'])->on('categoria')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recompensa', function (Blueprint $table) {
            $table->dropForeign('recompensa_ibfk_1');
        });
    }
};
