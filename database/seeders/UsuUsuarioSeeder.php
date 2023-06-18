<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class UsuUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('usu_usuario')->insert([
            'usu_id_per' => 1,
            'usu_usuario' => 1,
            'usu_pass' => Hash::make('password'),
            'usu_rol' => 1,
            'usu_estado' => 1,
            'usu_usu_creacion' => 1,
            'usu_usu_modificacion' => 1,
            'usu_fecha_creacion' => Carbon::now(),
            'usu_fecha_modificacion' => Carbon::now(),
        ]);

    }
}