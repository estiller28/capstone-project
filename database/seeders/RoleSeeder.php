<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = [
            'Super Admin',
            'User',
            'Admin',
            'Citizen',
        ];

        foreach ($role as $roles ){
            Role::create(['name' => $roles]);
        }


    }
}

