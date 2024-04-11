<?php

namespace Database\Seeders;

use App\Models\Customer;
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
        $user = User::create([
            'username' => 'Admin',
            'password' => bcrypt('admin123'),
            'email' => 'admin@gmail.com',
            'role' => 'admin'
        ]);

        Customer::create([
            'user_id' => $user->id,
            'nama_lengkap' => 'Admin Cempaka',
            'telp' => '087383918239',
        ]);
    }
}
