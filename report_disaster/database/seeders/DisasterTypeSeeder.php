<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DisasterType;

class DisasterTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Flood', 'description' => 'Water overflow causing property damage'],
            ['name' => 'Fire', 'description' => 'Uncontrolled burning causing destruction'],
            ['name' => 'Accident', 'description' => 'Road or traffic accidents'],
            ['name' => 'Building Collapse', 'description' => 'Structural failure of buildings'],
            ['name' => 'Erosion', 'description' => 'Land degradation and soil erosion'],
            ['name' => 'Medical Emergency', 'description' => 'Health-related emergencies'],
        ];

        foreach ($types as $type) {
            DisasterType::create($type);
        }
    }
}