<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Tạo tài khoản admin
        $user = new User;
        $user->name = 'Chuc';
        $user->email = 'chuc@gmail.com';
        $user->is_admin = true;  // Gán is_admin = true cho admin
        $user->role = 'admin';   // Gán role = 'admin' cho tài khoản admin
        $user->password = bcrypt('123123');
        $user->save(); 
    }
}


