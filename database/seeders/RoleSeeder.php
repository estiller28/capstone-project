<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

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


       $superAdmin =  User::create([
            'name' => 'Super Admin',
            'email' => 'super_admin@gmail.com',
            'password' => bcrypt('password'),

        ]);

        $superAdmin->assignRole('Super Admin');



    }
}

