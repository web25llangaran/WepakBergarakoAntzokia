<?php

use App\Enums\EkitaldiMota;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // up(): crea la tabla "ekitaldiak" (eventos): sala (clave foránea), nombre, descripción, tipo, fecha e imagen.
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
            $table->string('irudia')->nullable();
            $table->timestamps();
        });
    }

    // down(): borra la tabla si se deshace la migración.
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekitaldiak');
    }
};
