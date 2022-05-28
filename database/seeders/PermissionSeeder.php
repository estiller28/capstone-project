<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Settings',
            'Citizens',
            'Household Profiling',
            'Blotter Management',
            'Events',
            'Certificates',
            'Visitors Logbook',
            'Citizens Request',
        ];

        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }

    }
}
