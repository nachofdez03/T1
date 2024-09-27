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
        Schema::create('productos', function (Blueprint $table) {
            // Aquí usamos Blueprint para definir las columnas de la tabla
            $table->id(); // Crea una columna id autoincremental
            $table->string('nombre'); // Crea una columna de tipo string para el nombre
            $table->text('descripcion'); // Crea una columna para la descripción
            $table->foreignId('categoria_id')->constrained(); // Crea una clave foránea
            $table->integer('cantidad_stock'); // Crea una columna para la cantidad en stock
            $table->timestamps(); // Crea columnas created_at y updated_at

        });
    }

    // constrained También establece la opción de onDelete('cascade') automáticamente, 
    // lo que significa que si una categoría es eliminada, los productos relacionados también se eliminarán. 
    // Esto es útil para mantener la integridad referencial.

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
