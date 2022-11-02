<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funcionarios')->insert([
            'nome' => 'Paulo',
            'dataNasc' => Carbon::create('1999', '06', '23'),
            'telefone' => '11 123456789',
            'email' => 'paulo@gmail.com',
            'departamento_id' => 1,
            'empresa_id' => 1
        ]);

        DB::table('funcionarios')->insert([
            'nome' => 'Velton',
            'dataNasc' => Carbon::create('1996', '02', '19'),
            'telefone' => '11 123456789',
            'email' => 'paulo@gmail.com',
            'departamento_id' => 2,
            'empresa_id' => 2
        ]);

        DB::table('funcionarios')->insert([
            'nome' => 'Makoto',
            'dataNasc' => Carbon::create('2001', '10', '03'),
            'telefone' => '11 123456789',
            'email' => 'paulo@gmail.com',
            'departamento_id' => 3,
            'empresa_id' => 3
        ]);

        DB::table('funcionarios')->insert([
            'nome' => 'Kross',
            'dataNasc' => Carbon::create('1997', '04', '30'),
            'telefone' => '11 123456789',
            'email' => 'paulo@gmail.com',
            'departamento_id' => 4,
            'empresa_id' => 4
        ]);
    }
}
