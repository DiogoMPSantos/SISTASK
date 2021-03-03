<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'nome' => 'Urgente',
       ]);

       DB::table('categoria_tarefa')->insert([
        'tarefa_id' => 1,
        'categoria_id' => 1,
       ]);
    }
}
