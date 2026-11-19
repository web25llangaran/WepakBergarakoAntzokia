<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Segurtasun kontua: eserleku bera ezin da bi aldiz saldu ekitaldi berean.
     */
    public function up(): void
    {
        // Añade un índice único (evento + butaca): la BD no deja vender la misma butaca dos veces en el mismo evento.
        Schema::table('sarrerak', function (Blueprint $table) {
            $table->unique(['id_ekitaldia', 'id_eserlekua']);
        });
    }

    // down(): quita el índice único si se deshace la migración.
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sarrerak', function (Blueprint $table) {
            $table->dropUnique(['id_ekitaldia', 'id_eserlekua']);
        });
    }
};
