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
        Schema::create('sarrerak', function (Blueprint $table) {
            $table->id();
            // Taulan entitate erlazio ereduan definitutako zutabeak gehitu:
            $table->foreignId('id_ekitaldia')->constrained('ekitaldiak')->cascadeOnDelete();
            $table->dateTime('data');
            $table->unsignedSmallInteger('lerro_zenb');
            $table->unsignedSmallInteger('exerleku_zenb');
            $table->enum('mota', ['arrunta','silver_economy'])->default('arrunta');
            $table->decimal('prezioa',8,2);
            $table->timestamps();
            //hau seguridade kontue da: Ez dadila butaka bera behin baino gehiagotan erosi ekitaldi berean.
            $table->unique(['id_ekitaldia', 'lerro_zenb', 'exerleku_zenb']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sarrerak');
    }
};
