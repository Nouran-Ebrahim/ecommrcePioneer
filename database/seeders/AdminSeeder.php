<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $first_role_id = Role::first()->id;

        Admin::create([
            'name' => 'admin name',
            'email' => 'admin@gmail.com',
            'password' => bcrypt( '12345678'),
            'status' => 1,
            'role_id' => $first_role_id

        ]);
    }
}
