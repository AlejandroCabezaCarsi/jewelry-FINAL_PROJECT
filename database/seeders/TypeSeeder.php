<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table()-> insert([
            
            ['name'=>'anillo'],
            ['name'=>'collar'],
            ['name'=>'colgante'],
            ['name'=>'gargantilla'],
            ['name'=>'pulsera'],
            ['name'=>'tobillera'],
            ['name'=>'piercing'],
            ['name'=>'reloj'],
            ['name'=>'alianza'],

        ]);
    }
}
