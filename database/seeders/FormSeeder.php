<?php

namespace Database\Seeders;
use App\Models\Certificates;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $certificates = [
            'Certificate of Indigency',
            'Barangay Clearance',
            'Business Permit',
            'Letter of Acceptance',
        ];

        foreach ($certificates as $certificate){
            Certificates::create(['form_name' => $certificate]);
        }
    }
}
