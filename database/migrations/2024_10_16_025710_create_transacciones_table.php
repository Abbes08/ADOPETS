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
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id('transaccion_id');
            $table->unsignedBigInteger('mascota_id');
            $table->unsignedBigInteger('user_id'); // Usuario que adopta o compra
            $table->enum('tipo', ['adopcion', 'compra']);
            $table->decimal('precio', 8, 2)->nullable(); // Precio en caso de compra
            $table->timestamp('fecha_transaccion');
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
        Schema::dropIfExists('transacciones');
    }
};
