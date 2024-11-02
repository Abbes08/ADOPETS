<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio', function (Blueprint $table) {
            $table->id(); // ID de servicio
            $table->string('nombre', 255); // Nombre del servicio
            $table->text('descripcion')->nullable(); // Descripción, opcional
            $table->boolean('estado')->default(true); // Estado (activo o inactivo)
            $table->timestamps(); // Timestamps (created_at y updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio');
    }
}
