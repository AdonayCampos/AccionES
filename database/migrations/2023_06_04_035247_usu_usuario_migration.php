<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usu_usuario', function (Blueprint $table) {

            $table->id('usu_id');
            $table->unsignedBigInteger('usu_id_per');
            $table->string('usu_usuario', 150);
            $table->string('usu_pass', 500);
            $table->unsignedBigInteger('usu_rol');
            $table->unsignedBigInteger('usu_estado');
            $table->unsignedBigInteger('usu_usu_creacion');
            $table->unsignedBigInteger('usu_usu_modificacion');
            $table->dateTime('usu_fecha_creacion');
            $table->dateTime('usu_fecha_modificacion');
            
            $table->foreign('usu_id_per')->references('id')->on('empleados');
            // Agrega otras relaciones de clave externa si es necesario
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Eliminar restricción de clave externa
        Schema::table('usu_usuario', function (Blueprint $table) {
            $table->dropForeign(['usu_id_per']);
        });

        Schema::dropIfExists('usu_usuario');
    }
};
