<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id(); // Clave primaria para la transacción
            $table->unsignedBigInteger('mascota_id'); // Referencia a la mascota
            $table->unsignedBigInteger('user_id'); // Referencia al usuario
            $table->string('tipo', 50); // Tipo de transacción (e.g., compra, adopcion)
            $table->decimal('precio', 10, 2)->default(0); // Precio de la transacción (0 si es adopción)
            $table->timestamp('fecha_transaccion'); // Fecha de la transacción
            $table->timestamps();

            // Claves foráneas
            $table->foreign('mascota_id')->references('mascota_id')->on('mascotas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacciones');
    }
}
