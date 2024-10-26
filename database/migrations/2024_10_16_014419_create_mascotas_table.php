<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMascotasTable extends Migration
{
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id('mascota_id'); // Clave primaria
            $table->string('nombre');
            $table->integer('edad'); // Edad en meses o años
            $table->enum('sexo', ['Macho', 'Hembra']);
            $table->text('caracteristicas'); // Características de la mascota
            $table->boolean('es_venta')->default(false); // Si es en venta o en adopción
            $table->string('raza')->nullable(); // Solo para mascotas en venta
            $table->decimal('precio', 8, 2)->nullable(); // Precio para mascotas en venta
            $table->json('fotos'); // Almacenar nombres de archivos de imágenes
            $table->string('whatsapp_link'); // Link de contacto por WhatsApp
            $table->unsignedBigInteger('user_id'); // Usuario que registra la mascota
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Relación con la tabla users
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mascotas');
    }
}