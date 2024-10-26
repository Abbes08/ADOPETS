<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('publicidad', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('precio', 8, 2); 
            $table->text('descripcion');
            $table->string('telefono');
            $table->string('imagen');
            $table->date('fechaInicio');
            $table->date('fechaFinal'); 
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('estado')->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Elimina la tabla 'publicidad' correctamente
        Schema::dropIfExists('publicidad');
    }
};

