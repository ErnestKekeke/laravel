<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Projects
        DB::table('projects')->insert([
            [
                'title' => 'Education for All Initiative',
                'description' => 'Providing quality education and learning materials to underprivileged children in rural communities across Nigeria.',
                'target_amount' => 5000000.00,
                'raised_amount' => 2350000.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Healthcare Outreach Program',
                'description' => 'Delivering free medical services, medications, and health education to underserved areas.',
                'target_amount' => 3000000.00,
                'raised_amount' => 1800000.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Clean Water Project',
                'description' => 'Building boreholes and water treatment facilities to provide clean drinking water to communities.',
                'target_amount' => 8000000.00,
                'raised_amount' => 3200000.00,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Donors
        DB::table('donors')->insert([
            [
                'name' => 'Adewale Johnson',
                'email' => 'adewale.j@example.com',
                'phone' => '08012345678',
                'created_at' => now(),
            ],
            [
                'name' => 'Chioma Okafor',
                'email' => 'chioma.ok@example.com',
                'phone' => '08098765432',
                'created_at' => now(),
            ],
            [
                'name' => 'Ibrahim Musa',
                'email' => 'ibrahim.m@example.com',
                'phone' => '07034567890',
                'created_at' => now(),
            ],
        ]);

        // Seed Donations
        DB::table('donations')->insert([
            [
                'donor_id' => 1,
                'amount' => 50000.00,
                'project_name' => 'Education for All Initiative',
                'payment_method' => 'card',
                'status' => 'completed',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'donor_id' => 2,
                'amount' => 100000.00,
                'project_name' => 'Healthcare Outreach Program',
                'payment_method' => 'bank_transfer',
                'status' => 'completed',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'donor_id' => 3,
                'amount' => 75000.00,
                'project_name' => 'Clean Water Project',
                'payment_method' => 'ussd',
                'status' => 'completed',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ]);

        // Seed Beneficiaries
        DB::table('beneficiaries')->insert([
            [
                'name' => 'Blessing Eze',
                'location' => 'Enugu State',
                'project_id' => 1,
                'assistance_type' => 'School Supplies and Tuition',
                'created_at' => now(),
            ],
            [
                'name' => 'Fatima Abubakar',
                'location' => 'Kano State',
                'project_id' => 2,
                'assistance_type' => 'Free Medical Treatment',
                'created_at' => now(),
            ],
            [
                'name' => 'Oluwaseun Adebayo',
                'location' => 'Oyo State',
                'project_id' => 3,
                'assistance_type' => 'Clean Water Access',
                'created_at' => now(),
            ],
        ]);
    }
}