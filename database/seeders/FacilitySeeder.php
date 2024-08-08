<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('facilities')->insert([
            [
                'user_id' => 2,
                'name' => 'St. Elizabeth Hospital',
                'address' => '123 Main St, New York, NY 10030',
            ],
            [
                'user_id' => 3,
                'name' => 'General Santos Doctor Hospital Inc.	',
                'address' => 'Gen. Santos City, South Cotabato',
            ],
            [
                'user_id' => 4,
                'name' => 'Sarmed',
                'address' => 'Manila, Metro Manila',
            ],
            [
                'user_id' => 5,
                'name' => 'ACE Medical Center',
                'address' => 'Manila, Metro Manila',
            ],
            [
                'user_id' => 6,
                'name' => 'St. Louis Hospital',
                'address' => 'New Isabela, Tacurong City, Sultan Kudarat',
            ],
            [
                'user_id' => 7,
                'name' => 'Northern Mindanao Medical Center',
                'address' => 'Cagayan de Oro, Misamis Oriental',
            ],
        ]);
    }
}
