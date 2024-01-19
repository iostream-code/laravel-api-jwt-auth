<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                // 'role_id' => '1',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'ADMIN',
                'created_at' => Carbon::now(),
            ],
            [
                // 'role_id' => '2',
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user123'),
                'role' => 'USER',
                'created_at' => Carbon::now(),
            ],
        ];

        User::insert($data);
    }
}
