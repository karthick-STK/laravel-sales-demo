<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('Products')->insert([
            'name' => Str::random(10),
            'price' => mt_rand(0,999),
            'description' => Str::random(100),            
        ]);      
    }
}
