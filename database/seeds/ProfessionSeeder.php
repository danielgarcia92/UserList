<?php

use App\Profession;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Profession::class, 20)->create();
//        Profession::create([
//            'title' => 'Diseñador web'
//        ]);
//        DB::table('professions')->insert([
//            'title' => 'Ingeniero electrónico'
//        ]);

    }
}
