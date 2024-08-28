<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('patients')->insert([
            [
                'facility_id' => 1,
            ],
            [
               'facility_id' => 2,
            ],
            [
                'facility_id' => 3,
            ],
            [
                'facility_id' => 4,
            ],
            [
                'facility_id' => 5,
            ],
        ]);

        DB::table('patient_information')->insert([
            [
                'patient_id' => 1,
                'philhealth_number' => '18564521234',
                'first_name' => 'Mary',
                'last_name' => 'Doe',
                // 'address' => 'Tacurong City, Sultan Kudarat',
                // 'date_of_birth' => '1990-01-01',
            ],
            [
                'patient_id' => 2,
                'philhealth_number' => '45634982345',
                'first_name' => 'John',
                'last_name' => 'Doe',
                // 'address' => 'Cagayan de Oro, Misamis Oriental',
                // 'date_of_birth' => '1995-08-04',
            ],
            [
                'patient_id' => 3,
                'philhealth_number' => '12345678901',
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                // 'address' => 'Manila, Metro Manila',
                // 'date_of_birth' => '1992-03-08',
            ],
            [
                'patient_id' => 4,
                'philhealth_number' => '98762534123',
                'first_name' => 'Juan',
                'last_name' => 'Dela Cruz',
                // 'address' => 'Gen. Santos City, South Cotabato',
                // 'date_of_birth' => '1993-07-02',
            ],
            [
                'patient_id' => 5,
                'philhealth_number' => '45678912345',
                'first_name' => 'Maria',
                'last_name' => 'Dela Cruz',
                // 'address' => 'New Isabela, Tacurong City, Sultan Kudarat',
                // 'date_of_birth' => '1991-05-15',
            ],
        ]);


    }
}
