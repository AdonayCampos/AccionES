<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            'per_id_mun_residencia' => 1,
            'per_primer_nombre' => 'Administrador',
            'per_primer_apellido' => 'Sistema',
            'per_dui' => '06000000-0',
            'per_fecha_nacimiento' => '2023-06-06',
            'per_codigo_emp' => '0001',
            'per_direccion_residencia' => 'San Salvador',
            'per_estado' => 1,
            'per_usu_creacion' => 1,
            'per_usu_modificacion' => 1,
            'per_fecha_creacion' => Carbon::now(),
            'per_fecha_modificacion' => Carbon::now(),
        );

        DB::table('per_persona')->insert($data);
    }
}