<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'test@gmail.com',
            'first_name'=>'hamza',
            'last_name'=>'marini',
            'is_admin'=>1,
            'is_writer'=>1,
            'password'=>bcrypt('1234567890')
        ]);

        User::create([
            'email' => 'test1@gmail.com',
            'first_name'=>'hicham',
            'last_name'=>'karimi',
            'is_admin'=>0,
            'is_writer'=>1,
            'password'=>bcrypt('1234567890')
        ]);
    }
}
