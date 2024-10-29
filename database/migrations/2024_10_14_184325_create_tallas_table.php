<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tallas', function (Blueprint $table) {
            $table->id(); // Clave primaria que incrementa la BBDD
            $table->string('nombre'); // ( XS, S, M... )
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tallas'); // Borra la tabla si se revierte la migración
    }
};
