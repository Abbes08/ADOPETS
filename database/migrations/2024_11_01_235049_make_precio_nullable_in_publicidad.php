<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakePrecioNullableInPublicidad extends Migration
{
    public function up()
    {
        Schema::table('publicidad', function (Blueprint $table) {
            $table->decimal('precio', 8, 2)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('publicidad', function (Blueprint $table) {
            $table->decimal('precio', 8, 2)->nullable(false)->change();
        });
    }
}
