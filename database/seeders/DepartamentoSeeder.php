<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamentos')->insert([
            'nome' => 'RH',
            'descricao' => 'Gestão de Recursos Humanos, Gestão de Pessoas, Administração de Recursos Humanos ou Administração de Pessoas'
        ]);

        DB::table('departamentos')->insert([
            'nome' => 'Financeiro',
            'descricao' => ' realiza o planejamento, a organização e o controle de todas as atividades'
        ]);

        DB::table('departamentos')->insert([
            'nome' => 'Desenvolvimento',
            'descricao' => 'Criação de softwares'
        ]);

        DB::table('departamentos')->insert([
            'nome' => 'Operações',
            'descricao' => 'Contribuição para o funcionamento da empresa.'
        ]);
    }
}
