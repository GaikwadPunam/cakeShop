<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = New User();
        $user->name ="Admin";
        $user->email ="user@gmail.com";
        $user->password =bcrypt("user@gmail.com");
        $user->isAdmin =1;
        $user->save();


    }
}
