<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

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
            'settings',
            'settings-purok',
            'settings-barangay-profile',
            'citizens',
            'household',
            'blotter-management',
            'events',
            'certificates',
            'visitors',
            'citizens-request',
        ];

        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }

    }
}
