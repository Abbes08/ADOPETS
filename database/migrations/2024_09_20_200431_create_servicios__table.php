<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('servicio', function (Blueprint $table) {
            $table->bigIncrements('servicio_id');
            $table->string('nombre');
            $table->text('descripcion')->nullable();  // Permite que la descripción sea opcional
            $table->boolean('estado')->default(true);  // Activo por defecto
            $table->timestamps();  // Para created_at y updated_at
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('servicio');
    }
    
};
