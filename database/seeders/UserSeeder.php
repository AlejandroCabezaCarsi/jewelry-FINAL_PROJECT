<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'=>'alex',
                'surname'=>'cabeza',
                'email'=>'alex@alex.com',
                'password'=> bcrypt('Abcd1234'),
                'city'=>'PRUEBA',
                'postalCode'=>'PRUEBA',
                'address'=>'PRUEBA',
                'role_ID'=>1,

            ],
            [
                'name'=>'superAdmin',
                'surname'=>'superAdmin',
                'email'=>'superAdmin@superAdmin.com',
                'password'=> bcrypt('Abcd1234'),
                'city'=>'PRUEBA',
                'postalCode'=>'PRUEBA',
                'address'=>'PRUEBA',
                'role_ID'=>1,

            ],
            [
                'name'=>'admin',
                'surname'=>'admin',
                'email'=>'admin@admin.com',
                'password'=> bcrypt('Abcd1234'),
                'city'=>'PRUEBA',
                'postalCode'=>'PRUEBA',
                'address'=>'PRUEBA',
                'role_ID'=>2,

            ],
            [
                'name'=>'worker',
                'surname'=>'worker',
                'email'=>'worker@worker.com',
                'password'=> bcrypt('Abcd1234'),
                'city'=>'PRUEBA',
                'postalCode'=>'PRUEBA',
                'address'=>'PRUEBA',
                'role_ID'=>3,

            ],
            [
                'name'=>'userDeleted1',
                'surname'=>'userDeleted1',
                'email'=>'userDeleted1@userDeleted1.com',
                'password'=> bcrypt('Abcd1234'),
                'city'=>'PRUEBA',
                'postalCode'=>'PRUEBA',
                'address'=>'PRUEBA',
                'role_ID'=>4,

            ],
            [
                'name'=>'userDeleted2',
                'surname'=>'userDeleted2',
                'email'=>'userDeleted2@userDeleted2.com',
                'password'=> bcrypt('Abcd1234'),
                'city'=>'PRUEBA',
                'postalCode'=>'PRUEBA',
                'address'=>'PRUEBA',
                'role_ID'=>4,

            ],
            [
                'name'=>'userDeleted3',
                'surname'=>'userDeleted3',
                'email'=>'userDeleted3@userDeleted3.com',
                'password'=> bcrypt('Abcd1234'),
                'city'=>'PRUEBA',
                'postalCode'=>'PRUEBA',
                'address'=>'PRUEBA',
                'role_ID'=>4,

            ],
            
        ]);

        $user = User::where('email', 'userDeleted1@userDeleted1.com')->first();
        $user->delete();
        $user2 = User::where('email', 'userDeleted2@userDeleted2.com')->first();
        $user2->delete();
        $user3 = User::where('email', 'userDeleted3@userDeleted3.com')->first();
        $user3->delete();
    }
}
