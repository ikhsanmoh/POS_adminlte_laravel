<?php

use Illuminate\Database\Seeder;

//Memanggil Library Faker
use Faker\Factory as Faker;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $faker = Faker::create('id_ID');

        // for ($i=0; $i < 10 ; $i++) { 
        //     DB::table('tb_produk')
        //     ->insert([
        //         'nama_barang'=>$faker->word,
        //         'harga'=>$faker->numberBetween(100000, 1000000),
        //         'stok'=>$faker->numberBetween(1, 500)
        //     ]);
        // }
        
    }
}
