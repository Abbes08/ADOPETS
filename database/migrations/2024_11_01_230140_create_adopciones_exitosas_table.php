<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdopcionesExitosasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adopciones_exitosas', function (Blueprint $table) {
            $table->bigIncrements('adop_id'); // Define la clave primaria como adop_id
            $table->unsignedBigInteger('user_id'); // Llave foránea a usuarios
            $table->unsignedBigInteger('mascota_id'); // Llave foránea a mascotas
            $table->text('reseña');
            $table->date('fecha_reseña');
            $table->string('imagen')->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
        
            // Definir las claves foráneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('mascota_id')->references('mascota_id')->on('mascotas')->onDelete('cascade');
        });
        
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adopciones_exitosas');
    }
}
