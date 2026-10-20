<?php

use App\Enums\EserlekuMota;

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
        Schema::create('eserlekuak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_aretoa')->constrained('aretoak')->cascadeOnDelete();
            $table->unsignedSmallInteger('lerro_zenb');
            $table->unsignedSmallInteger('eserleku_zenb');
            $table->string('eserleku_mota')->default (EserlekuMota::Arrunta->value);
            $table->timestamps();
            $table->unique(['id_aretoa', 'lerro_zenb', 'eserleku_zenb']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eserlekuak');
    }
};
