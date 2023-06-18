<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dep_departamento', function (Blueprint $table) {
            $table->increments('dep_id')->comment('Llave principal del Departamento del sistema');
            $table->string('dep_nombre', 150)->comment('Nombre del departamento');
            $table->integer('dep_estado')->comment('Estado del registro');
            $table->integer('dep_usu_creacion')->comment('Auditoría');
            $table->integer('dep_usu_modificacion')->comment('Auditoría');
            $table->datetime('dep_fecha_creacion')->comment('Auditoría');
            $table->datetime('dep_fecha_modificacion')->comment('Auditoría');

            $table->index('dep_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dep_departamento');
    }
};