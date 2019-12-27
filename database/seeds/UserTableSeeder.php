<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Lucia";
        $user->email = "str4ngl3r@aol.com";
        $user->password = bcrypt('123456789');
        $user->save();
    }
}
