<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statusOrders') -> insert([

            ['name' => 'confirmed'],
            ['name' => 'sent'],
            ['name' => 'delivered'],

        ]);
    }
}
