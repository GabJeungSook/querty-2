<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('case_categories')->insert([
            [
                'name' => 'Acute Bronchitis',
            ],
            [
                'name' => 'Sepsis',
            ],
            [
                'name' => 'Dehydration',
            ],
            [
                'name' => 'Fever',
            ],
            [
                'name' => 'Abdominal pain',
            ],
            [
                'name' => 'Skin infections',
            ],
        ]);
    }
}
