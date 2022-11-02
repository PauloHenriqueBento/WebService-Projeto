<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EmpresaSeeder::class
        ]);

        $this->call([
            DepartamentoSeeder::class
        ]);

        $this->call([
            FuncionarioSeeder::class
        ]);
    }

}
