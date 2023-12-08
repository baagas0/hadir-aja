<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'code' => 'superadmin',
                'name' => 'Super Admin',
            ],
            [
                'code' => 'school_manager',
                'name' => 'Pengelola Sekolah',
            ],
            [
                'code' => 'user',
                'name' => 'Pengguna',
            ],
        ]);

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 1,
            'backoffice_login' => true,
        ]);
    }
}
