<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('adopciones_exitosas', function (Blueprint $table) {
            $table->id('adop_id');
            $table->unsignedBigInteger('mascota_id'); // Relación con la mascota adoptada
            $table->unsignedBigInteger('user_id'); // Usuario que realiza la reseña
            $table->text('reseña'); // Reseña del usuario
            $table->date('fecha_reseña'); // Fecha de la reseña
            $table->string('imagen')->nullable(); // Imagen opcional
            $table->boolean('estado')->default(true); // Estado (activo o inactivo)
            $table->timestamps();
        
            // Llaves foráneas
            $table->foreign('mascota_id')->references('mascota_id')->on('mascotas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adopciones_exitosas');
    }
};
