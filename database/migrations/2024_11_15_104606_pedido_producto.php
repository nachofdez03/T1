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
        Schema::create('pedido_producto', function (Blueprint $table) {
            $table->id(); // ID del registro en la tabla intermedia
            $table->foreignId('pedido_id') // Relación con la tabla 'pedidos'
                ->constrained('pedidos')
                ->onDelete('cascade');
            $table->foreignId('producto_id') // Relación con la tabla 'productos'
                ->constrained('productos')
                ->onDelete('cascade');
            $table->integer('cantidad'); // Cantidad del producto en este pedido
            $table->decimal('precio', 10, 2); // Precio del producto en el momento del pedido
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_producto');
    }
};
