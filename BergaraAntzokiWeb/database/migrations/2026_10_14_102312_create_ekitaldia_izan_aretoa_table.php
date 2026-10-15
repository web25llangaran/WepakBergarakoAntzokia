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
        Schema::create('ekitaldia_izan_aretoa', function (Blueprint $table) {
            $table->foreignId('id_ekitaldia')->constrained('ekitaldiak')->cascadeOnDelete();
            $table->foreignId('id_aretoa')->constrained('aretoak')->cascadeOnDelete();
            $table->primary(['id_ekitaldia', 'id_aretoa']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izan');
    }
};
