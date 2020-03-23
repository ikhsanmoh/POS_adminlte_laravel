<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('jabatan', 'Admin')->first();
        $kasirRole = Role::where('jabatan', 'Kasir')->first();

        $admin = User::create([
           'name' => 'Admin User',
           'email' => 'admin@gmail.com',
           'password' => Hash::make('password') 
        ]);

        $kasir = User::create([
            'name' => 'Kasir User',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('password') 
         ]);

         $admin->roles()->attach($adminRole);
         $kasir->roles()->attach($kasirRole);
    }
}
