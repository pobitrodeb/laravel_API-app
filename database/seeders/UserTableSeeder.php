<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Pobitrodeb', 'email' => 'pobitrodebnath001@gmail.com', 'password' => '12345678'],
            ['name' => 'kabilla', 'email' => 'pobitrodebnath00s1@gmail.com', 'password' => '12345678'],
            ['name' => 'shuvo', 'email' => 'pobitrodebnath001@sgmail.com', 'password' => '12345678'],
        ];
        User::insert($users);
    }
}
