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
        Schema::table('sarrerak', function (Blueprint $table) {
            $table->unique(['id_ekitaldia', 'id_eserlekua']);
        });
    }

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
