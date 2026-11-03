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
        Schema::create('aretoak', function (Blueprint $table) {
            $table->id();
            // Taulan entitate erlazio ereduan definitutako zutabeak gehitu:
            $table->string('izena')->unique();
            $table->unsignedSmallInteger('exerleku_kopurua');
            $table->unsignedSmallInteger('lerro_kopurua');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aretoak');
    }
};
