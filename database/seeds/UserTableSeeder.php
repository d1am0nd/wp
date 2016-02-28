<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User;
        $user->username = "test";
        $user->email = "test@test";
        $user->password = \Hash::make('test');
        $user->save(); 
    }
}
