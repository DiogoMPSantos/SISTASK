<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('candidates')->insert([
            'name' => 'User 1',
            'email' => 'userteste1@gmail.com',
            'old' => 12,
            'url' => 'https://laravel.com/docs/8.x/seeding',
       ]);
    }
}
