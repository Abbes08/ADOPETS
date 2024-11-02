<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicidad', function (Blueprint $table) {
            $table->id(); // ID automático
            $table->string('nombre'); // Nombre de la publicidad
            $table->decimal('precio', 8, 2); // Precio de la publicidad
            $table->text('descripcion')->nullable(); // Descripción de la publicidad
            $table->string('telefono', 15); // Teléfono de contacto
            $table->date('fechaInicio'); // Fecha de inicio de la publicidad
            $table->date('fechaFinal'); // Fecha de finalización de la publicidad
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID de usuario (relación con la tabla `users`)
            $table->string('imagen')->nullable(); // Ruta de la imagen (opcional)
            $table->enum('estado', ['activo', 'inactivo'])->default('activo'); // Estado de la publicidad (activo o inactivo)
            $table->timestamps(); // Campos de creación y actualización automática
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicidad');
    }
}
