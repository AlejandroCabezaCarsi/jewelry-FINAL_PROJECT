<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stores') -> insert([
            [   
                'address'=>'C/Doctor Manuel Candela, 72',
                'postalCode'=>46022,
                'email'=>'joyeriasylvieCandela@gmail.com',
                'phoneNumber'=>963725688,
                'city'=>'Valencia'
            ],
            [
                'address'=>'C/Mare de Deu, 7',
                'postalCode'=>46410,
                'email'=>'joyeriasylvieSueca@gmail.com',
                'phoneNumber'=>961712156,
                'city'=>'Sueca'
            ]
        ]);
    }
}
