<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // up(): crea la tabla "sarrerak" (entradas): evento, butaca y usuario (claves foráneas) y el precio.
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sarrerak', function (Blueprint $table) {
            $table->id();
            // Taulan entitate erlazio ereduan definitutako zutabeak gehitu:
            $table->foreignId('id_ekitaldia')->constrained('ekitaldiak')->cascadeOnDelete();
            // $table->foreignId('id_aretoa')->constrained('aretoak')->cascadeOnDelete();
            $table->foreignId('id_eserlekua')->constrained('eserlekuak')->cascadeOnDelete();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            // $table->dateTime('data');
            $table->decimal('prezioa',8,2);
            $table->timestamps();
            //hau seguridade kontue da: Ez dadila butaka bera behin baino gehiagotan erosi ekitaldi berean.
            // $table->unique(['id_ekitaldia', 'id_aretoa', 'id_eserlekua']);
        });
    }

    // down(): borra la tabla si se deshace la migración.
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sarrerak');
    }
};
