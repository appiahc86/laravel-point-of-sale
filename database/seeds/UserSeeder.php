<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::all()->count() < 1){
            User::create([

               'name'     => 'Innocent',
               'username' => 'innocent',
               'role'     => 1,
               'password' => Hash::make('Passwd@123')

            ]);
        }
    }
}
