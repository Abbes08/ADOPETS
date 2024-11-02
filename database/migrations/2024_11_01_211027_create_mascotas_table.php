<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->bigIncrements('mascota_id'); // Clave primaria
            $table->string('nombre', 255); // Nombre
            $table->integer('edad'); // Edad
            $table->enum('sexo', ['Macho', 'Hembra']); // Sexo
            $table->text('caracteristicas'); // Características
            $table->boolean('es_venta')->nullable(); // Venta o adopción
            $table->string('raza')->nullable(); // Raza (opcional)
            $table->decimal('precio', 8, 2)->nullable(); // Precio (opcional)
            $table->string('telefono', 15); // Teléfono
            $table->text('fotos')->nullable(); // Fotos (opcional, puedes guardar un JSON o ruta de imagen)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con usuario
            $table->boolean('activo')->default(true); // Activo o inactivo
            $table->timestamps(); // Timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mascotas');
    }
}
