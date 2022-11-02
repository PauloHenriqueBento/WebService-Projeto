<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert([
            'nome' => 'SENAC',
            'CNPJ' => random_int(11111111111111, 99999999999999)
        ]);

        DB::table('empresas')->insert([
            'nome' => 'Google',
            'CNPJ' => random_int(11111111111111, 99999999999999)
        ]);

        DB::table('empresas')->insert([
            'nome' => 'Microsoft',
            'CNPJ' => random_int(11111111111111, 99999999999999)
        ]);

        DB::table('empresas')->insert([
            'nome' => 'Apple',
            'CNPJ' => random_int(11111111111111, 99999999999999)
        ]);
    }
}
