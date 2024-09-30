<?php

namespace Database\Seeders;

use App\Models\Cabang;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PERUSAHAAN
        Cabang::insert([
            'nama_cabang' => 'SKY BOX',
        ]);
        // ROLE
        Role::insert([
            'nama_role' => 'Admin',
            'role' => '1',
        ]);
        Role::insert([
            'nama_role' => 'Manager',
            'role' => '2',
        ]);
        Role::insert([
            'nama_role' => 'Kasir',
            'role' => '3',
        ]);
        // User
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('sidoarjo1'),
                'id_role' => 1,
                'id_cabang' => 1,
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => bcrypt('sidoarjo1'),
                'id_role' => 2,
                'id_cabang' => 1,
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@gmail.com',
                'password' => bcrypt('sidoarjo1'),
                'id_role' => 3,
                'id_cabang' => 1,
            ],
        ]);
    }
}
