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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // Columna ID autoincremental
            $table->string('dni', 8); // Campo DNI con longitud de 8 caracteres
            $table->string('nombre', 50); // Campo Nombre con máximo 50 caracteres
            $table->string('apellido', 50); // Campo Apellido con máximo 50 caracteres
            $table->string('correo', 100)->unique(); // Campo Correo único y de hasta 100 caracteres
            $table->string('password'); // Campo Password (en caso de que uses hash, no necesitas especificar longitud)
            $table->tinyInteger('rol')->default(0); // Define el valor por defecto
            $table->timestamps(); // Crea columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
