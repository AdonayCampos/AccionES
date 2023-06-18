<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Seeds extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([DepDepartamentoSeeder::class, MunMunicipioSeeder::class, PerPersonaSeeder::class, UsuUsuarioSeeder::class]);
    }
}