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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();  // id del pedido
            $table->string('nombre_cliente');
            $table->string('email_cliente');
            $table->string('direccion');
            $table->decimal('total', 10, 2);

            // Relación con la tabla 'pedido_estado' para definir el estado del pedido
            $table->foreignId('pedido_estado_id')
                ->constrained('pedido_estado')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
