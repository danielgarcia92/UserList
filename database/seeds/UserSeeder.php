<?php

use App\User;
use App\Profession;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'correo1@correo.mx',
            'password' => bcrypt('password'),
            'profession_id' => Profession::get()->random()->id,
            'is_admin' => true
        ]);

        factory(User::class, 49)->create([
            'password' => bcrypt('password'),
            'profession_id' => Profession::get()->random()->id,
        ]);

//        User::create([
//            'name' => 'Nombre1',
//            'email' => 'correo1@correo.mx',
//            'password' => bcrypt('password'),
//            'profession_id' => $professionId,
//            'is_admin' => true
//        ]);

//        DB::table('users')->insert([
//            'name' => 'Nombre1',
//            'email' => 'correo1@correo.mx',
//            'password' => bcrypt('password'),
//            'profession_id' => $professionId
//        ]);
    }
}
