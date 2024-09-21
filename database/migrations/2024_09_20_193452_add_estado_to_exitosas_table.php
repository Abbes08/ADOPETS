<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('exitosas', function (Blueprint $table) {
            $table->boolean('estado')->default(true)->after('Fecha'); // Agregar la columna "estado"
        });
    }
    
    public function down()
    {
        Schema::table('exitosas', function (Blueprint $table) {
            $table->dropColumn('estado'); // Eliminar la columna "estado" en caso de rollback
        });
    }
    
};
