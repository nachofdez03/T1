<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->unsignedBigInteger('talla_id')->after('categoria_id');  // after ( despues de la columna )
            $table->foreign('talla_id')->references('id')->on('tallas'); // Relación con la tabla tallas
            $table->integer('stock')->after('talla_id');  // Añadir columna stock después de talla_id
        });
    }

    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign(['talla_id']);  // Eliminar la clave foránea de talla_id
            $table->dropColumn('talla_id');  // Eliminar columna talla_id
            $table->dropColumn('stock');  // Eliminar columna stock
        });
    }

};
