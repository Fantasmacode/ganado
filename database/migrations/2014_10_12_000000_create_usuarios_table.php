<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombres_usuario', 30);
            $table->string('apellidos_usuario', 30);
            $table->string('direccion_usuario', 30);
            $table->string('correo_usuario', 50)->unique();
            $table->string('telefono_usuario', 20);
            $table->string('clave_usuario');
            $table->string('rol_usuario', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
