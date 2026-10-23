<?php

use App\Enums\EkitaldiMota;
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
        Schema::create('ekitaldiak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_aretoa')->constrained('aretoak')->cascadeOnDelete();
            $table->string('izena');
            $table->text('deskripzioa')->nullable();
            $table->string('ekitaldi_mota')->default(EkitaldiMota::Zinema->value);
            $table->dateTime('data');
            $table->string('irudia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekitaldiak');
    }
};
