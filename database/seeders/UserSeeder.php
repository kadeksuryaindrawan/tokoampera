<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'Admin',
            'password' => bcrypt('admin123'),
            'email' => 'admin@gmail.com',
            'role' => 'admin'
        ]);

        User::create([
            'username' => 'Customer',
            'password' => bcrypt('customer123'),
            'email' => 'customer@gmail.com',
            'role' => 'customer'
        ]);
    }
}
