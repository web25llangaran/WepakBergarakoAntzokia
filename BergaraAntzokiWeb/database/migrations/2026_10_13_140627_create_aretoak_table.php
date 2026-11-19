<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // up(): crea la tabla "aretoak" (salas) con su nombre, número de butacas y número de filas.
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aretoak', function (Blueprint $table) {
            $table->id();
            // Taulan entitate erlazio ereduan definitutako zutabeak gehitu:
            $table->string('izena')->unique();
            $table->unsignedSmallInteger('exerleku_kopurua');
            $table->unsignedSmallInteger('lerro_kopurua');
            $table->timestamps();
        });
    }

    // down(): borra la tabla si se deshace la migración.
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aretoak');
    }
};
