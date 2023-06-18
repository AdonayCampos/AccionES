<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepDepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //array de datos
        $departamentos = [
            ['dep_nombre' => 'Ahuachapán', 'dep_estado' => 1, 'dep_usu_creacion' => 1, 'dep_usu_modificacion' => 1, 'dep_fecha_creacion' => Carbon::now(), 'dep_fecha_modificacion' => Carbon::now()],
            ['dep_nombre' => 'Santa Ana', 'dep_estado' => 1, 'dep_usu_creacion' => 1, 'dep_usu_modificacion' => 1, 'dep_fecha_creacion' => Carbon::now(), 'dep_fecha_modificacion' => Carbon::now()],
            ['dep_nombre' => 'Sonsonate', 'dep_estado' => 1, 'dep_usu_creacion' => 1, 'dep_usu_modificacion' => 1, 'dep_fecha_creacion' => Carbon::now(), 'dep_fecha_modificacion' => Carbon::now()],
            ['dep_nombre' => 'Chalatenango', 'dep_estado' => 1, 'dep_usu_creacion' => 1, 'dep_usu_modificacion' => 1, 'dep_fecha_creacion' => Carbon::now(), 'dep_fecha_modificacion' => Carbon::now()],
            ['dep_nombre' => 'Cuscatlán', 'dep_estado' => 1, 'dep_usu_creacion' => 1, 'dep_usu_modificacion' => 1, 'dep_fecha_creacion' => Carbon::now(), 'dep_fecha_modificacion' => Carbon::now()],
            ['dep_nombre' => 'La Libertad', 'dep_estado' => 1, 'dep_usu_creacion' => 1, 'dep_usu_modificacion' => 1, 'dep_fecha_creacion' => Carbon::now(), 'dep_fecha_modificacion' => Carbon::now()],
            ['dep_nombre' => 'La Paz', 'dep_estado' => 1, 'dep_usu_creacion' => 1, 'dep_usu_modificacion' => 1, 'dep_fecha_creacion' => Carbon::now(), 'dep_fecha_modificacion' => Carbon::now()],
            ['dep_nombre' => 'La Unión', 'dep_estado' => 1, 'dep_usu_creacion' => 1, 'dep_usu_modificacion' => 1, 'dep_fecha_creacion' => Carbon::now(), 'dep_fecha_modificacion' => Carbon::now()],
            ['dep_nombre' => 'Morazán', 'dep_estado' => 1, 'dep_usu_creacion' => 1, 'dep_usu_modificacion' => 1, 'dep_fecha_creacion' => Carbon::now(), 'dep_fecha_modificacion' => Carbon::now()],
            ['dep_nombre' => 'San Miguel', 'dep_estado' => 1, 'dep_usu_creacion' => 1, 'dep_usu_modificacion' => 1, 'dep_fecha_creacion' => Carbon::now(), 'dep_fecha_modificacion' => Carbon::now()],
            ['dep_nombre' => 'San Salvador', 'dep_estado' => 1, 'dep_usu_creacion' => 1, 'dep_usu_modificacion' => 1, 'dep_fecha_creacion' => Carbon::now(), 'dep_fecha_modificacion' => Carbon::now()],
            ['dep_nombre' => 'San Vicente', 'dep_estado' => 1, 'dep_usu_creacion' => 1, 'dep_usu_modificacion' => 1, 'dep_fecha_creacion' => Carbon::now(), 'dep_fecha_modificacion' => Carbon::now()],
            ['dep_nombre' => 'Cabañas', 'dep_estado' => 1, 'dep_usu_creacion' => 1, 'dep_usu_modificacion' => 1, 'dep_fecha_creacion' => Carbon::now(), 'dep_fecha_modificacion' => Carbon::now()],
            ['dep_nombre' => 'Usulután', 'dep_estado' => 1, 'dep_usu_creacion' => 1, 'dep_usu_modificacion' => 1, 'dep_fecha_creacion' => Carbon::now(), 'dep_fecha_modificacion' => Carbon::now()]
        ];
        DB::table('dep_departamento')->insert($departamentos);
    }
}