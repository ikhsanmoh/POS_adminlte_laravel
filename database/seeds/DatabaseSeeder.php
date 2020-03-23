<?php

use Illuminate\Database\Seeder;
//Memanggil Library Faker
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        $this->call(RolesTableSeeder::class);

        // $faker = Faker::create('id_ID');

        // for ($i=0; $i < 10 ; $i++) { 
        //     DB::table('coba2')
        //     ->insert([
        //         'nama'=>$faker->name
        //     ]);
        // }
    }
}
